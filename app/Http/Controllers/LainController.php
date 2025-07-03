<?php

namespace App\Http\Controllers;

use App\Models\Lain;
use App\Services\NomorGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LainController extends Controller
{
    protected $nomorGenerator;

    public function __construct(NomorGeneratorService $nomorGenerator)
    {
        $this->nomorGenerator = $nomorGenerator;
    }

    /**
     * Menampilkan daftar semua pengajuan "Lainnya" (untuk admin & userhukum)
     */
    public function index(Request $request)
    {
        $query = Lain::with('opd')->latest();

        if ($request->has('search')) {
            $query->where('perihal', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_lain', 'like', '%' . $request->search . '%');
        }

        $lains = $query->paginate(15);
        return view('lain.index', compact('lains'));
    }

    /**
     * Menampilkan daftar pengajuan "Lainnya" milik user OPD sendiri
     */
    public function mySubmissions()
    {
        $lains = Lain::with('opd')
            ->where('id_opd', Auth::user()->id_opd)
            ->latest()
            ->paginate(15);
            
        return view('lain.index', compact('lains'));
    }

    /**
     * Menampilkan form untuk membuat pengajuan "Lainnya" baru
     */
    public function create()
    {
        $nomorBaru = $this->nomorGenerator->generateLain();
        return view('lain.create', [
            'kode_lain' => $nomorBaru['kode_lain'],
        ]);
    }

    /**
     * Menyimpan pengajuan "Lainnya" baru dari user OPD
     */
    public function store(Request $request)
    {
        $request->validate([
            'perihal' => 'required|string',
            'pemohon' => 'required|string',
        ]);

        $nomorBaru = $this->nomorGenerator->generateLain();
        
        Lain::create([
            'no_urut' => $nomorBaru['no_urut'],
            'kode_lain' => $nomorBaru['kode_lain'],
            'id_opd' => Auth::user()->id_opd,
            'tgl_pengajuan' => Carbon::now(),
            'perihal' => $request->perihal,
            'pemohon' => $request->pemohon,
            'tahun' => Carbon::now()->year,
            'status' => 'Proses',
            'tahap1' => Carbon::now(),
            'ket1' => 'Berkas diajukan oleh OPD.',
        ]);

        return redirect()->route('lain.mine')->with('success', 'Pengajuan Produk Hukum Lainnya berhasil dikirim.');
    }

    /**
     * Menampilkan detail sebuah pengajuan "Lainnya"
     */
    public function show(Lain $lain)
    {
        // Otorisasi: user OPD hanya boleh melihat data miliknya
        if (Auth::user()->level == 'user' && $lain->id_opd != Auth::user()->id_opd) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES');
        }
        return view('lain.show', compact('lain'));
    }
}