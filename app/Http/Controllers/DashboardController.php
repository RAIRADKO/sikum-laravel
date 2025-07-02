<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard aplikasi.
     * Logika dashboard bisa ditambahkan di sini,
     * seperti mengambil data rekapitulasi.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Contoh: Anda bisa menambahkan data untuk ditampilkan di dashboard
        // $jumlah_sk = Sk::count();
        // $jumlah_pb = Pb::count();
        
        return view('dashboard', [
            'user' => $user
            // 'jumlah_sk' => $jumlah_sk,
            // 'jumlah_pb' => $jumlah_pb,
        ]);
    }
}