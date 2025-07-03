<?php

namespace App\Http\Controllers;

use App\Models\Pb;
use App\Services\NomorGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PbController extends Controller
{
    protected $nomorGenerator;

    public function __construct(NomorGeneratorService $nomorGenerator)
    {
        $this->nomorGenerator = $nomorGenerator;
    }

    // Menampilkan daftar semua pengajuan PB (untuk admin & userhukum)
    public function index(Request $request)
    {
        $query = Pb::with('opd')->latest();

        if ($request->has('search')) {
            $query->where('perihal', 'like', '%' . $request->search . '%')
                  ->orWhere('kode_pb', 'like', '%' . $request->search . '%');
        }

        $pbs = $query->paginate(15);
        return view('pb.index', compact('pbs'));
    }

    // Menampilkan daftar pengajuan PB milik user OPD sendiri
    public function mySubmissions()
    {
        $pbs = Pb::with('opd')
            ->where('id_opd', Auth::user()->id_opd)
            ->latest()
            ->paginate(15);
            
        return view('pb.index', compact('pbs'));
    }

    // Menampilkan form untuk membuat pengajuan PB baru
    public function create()
    {
        $nomorBaru = $this->nomorGenerator->generatePb();
        return view('pb.create', [
            'kode_pb' => $nomorBaru['kode_pb'],
        ]);
    }

    // Menyimpan pengajuan PB baru dari user OPD
    public function store(Request $request)
    {
        $request->validate([
            'perihal' => 'required|string',
            'pemohon' => 'required|string',
        ]);

        $nomorBaru = $this->nomorGenerator->generatePb();
        
        Pb::create([
            'no_urut' => $nomorBaru['no_urut'],
            'kode_pb' => $nomorBaru['kode_pb'],
            'id_opd' => Auth::user()->id_opd,
            'tgl_pengajuan' => Carbon::now(),
            'perihal' => $request->perihal,
            'pemohon' => $request->pemohon,
            'tahun' => Carbon::now()->year,
            'status' => 'Proses',
            'tahap1' => Carbon::now(),
            'ket1' => 'Berkas diajukan oleh OPD.',
        ]);

        return redirect()->route('pb.mine')->with('success', 'Pengajuan Peraturan Bupati (PB) berhasil dikirim.');
    }

    // Menampilkan detail sebuah pengajuan PB
    public function show(Pb $pb)
    {
        // Otorisasi: user OPD hanya boleh melihat PB miliknya
        if (Auth::user()->level == 'user' && $pb->id_opd != Auth::user()->id_opd) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES');
        }
        return view('pb.show', compact('pb'));
    }
}