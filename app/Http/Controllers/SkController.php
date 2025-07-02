<?php

namespace App\Http\Controllers;

use App\Models\Sk;
use App\Models\Opd;
use App\Services\NomorGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SkController extends Controller
{
    protected $nomorGenerator;

    public function __construct(NomorGeneratorService $nomorGenerator)
    {
        $this->nomorGenerator = $nomorGenerator;
    }

    // Daftar SK (untuk admin & userhukum)
    public function index(Request $request)
    {
        $query = Sk::with('opd')->latest();

        // Fitur Pencarian
        if ($request->has('search')) {
            $query->where('perihal', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_sk', 'like', '%' . $request->search . '%');
        }

        $sks = $query->paginate(15);
        return view('sk.index', compact('sks'));
    }
    
    // Menampilkan daftar pengajuan milik user OPD sendiri
    public function mySubmissions()
    {
        $sks = Sk::with('opd')
            ->where('id_opd', Auth::user()->id_opd)
            ->latest()
            ->paginate(15);
            
        return view('sk.index', compact('sks'));
    }

    // Form membuat pengajuan SK (untuk user OPD)
    public function create()
    {
        $nomorBaru = $this->nomorGenerator->generateSk(); // Logika dari funckodesk.php
        return view('sk.create', [
            'no_urut' => $nomorBaru['no_urut'],
            'kode_sk' => $nomorBaru['kode_sk'],
        ]);
    }

    // Menyimpan pengajuan SK baru
    public function store(Request $request)
    {
        $request->validate(['perihal' => 'required|string', 'pemohon' => 'required|string']);

        $nomorBaru = $this->nomorGenerator->generateSk();
        
        Sk::create([
            'no_urut' => $nomorBaru['no_urut'],
            'kode_sk' => $nomorBaru['kode_sk'],
            'id_opd' => Auth::user()->id_opd,
            'tgl_pengajuan' => Carbon::now(),
            'perihal' => $request->perihal,
            'pemohon' => $request->pemohon,
            'tahun' => Carbon::now()->year,
            'status' => 'Proses',
            'tahap1' => Carbon::now(),
            'ket1' => 'Berkas diajukan oleh OPD.',
        ]);

        return redirect()->route('sk.mine')->with('success', 'Pengajuan SK berhasil dikirim.');
    }

    // Menampilkan detail SK dan alur prosesnya
    public function show(Sk $sk)
    {
        // Otorisasi: user OPD hanya boleh melihat SK miliknya
        if (Auth::user()->level == 'user' && $sk->id_opd != Auth::user()->id_opd) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES');
        }
        return view('sk.show', compact('sk'));
    }
    
    // Hapus dan Edit akan ditangani oleh admin jika diperlukan
}