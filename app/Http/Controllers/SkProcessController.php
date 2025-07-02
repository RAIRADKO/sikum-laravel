<?php

namespace App\Http\Controllers;

use App\Models\Sk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SkProcessController extends Controller
{
    /**
     * Mengupdate tahapan proses SK.
     * Logika ini menggantikan semua file aksidetailprosessk*.php
     */
    public function update(Request $request, Sk $sk)
    {
        $request->validate([
            'tahap' => 'required|integer|min:2|max:6',
            'keterangan' => 'required|string',
            'no_sk_final' => 'nullable|string'
        ]);

        $tahapField = 'tahap' . $request->tahap;
        $ketField = 'ket' . $request->tahap;

        $sk->$tahapField = Carbon::now();
        $sk->$ketField = $request->keterangan;

        // Jika ini adalah tahap terakhir (tahap 6)
        if ($request->tahap == 6) {
            $sk->status = 'Selesai';
            $sk->no_sk = $request->no_sk_final; // Menyimpan nomor SK final
        }

        $sk->save();

        return redirect()->route('sk.show', $sk)->with('success', 'Proses berhasil diperbarui.');
    }

    /**
     * Membatalkan atau menolak pengajuan.
     */
    public function cancel(Request $request, Sk $sk)
    {
        $request->validate(['catatan_pembatalan' => 'required|string']);

        $sk->status = 'Ditolak';
        $sk->catatan = $request->catatan_pembatalan;
        $sk->save();

        return redirect()->route('sk.show', $sk)->with('success', 'Pengajuan telah dibatalkan/ditolak.');
    }
}