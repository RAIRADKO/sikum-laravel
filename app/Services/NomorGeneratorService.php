<?php

namespace App\Services;

use App\Models\Sk;
use App\Models\Pb;
use App\Models\Lain;
use Carbon\Carbon;

class NomorGeneratorService
{
    /**
     * Generate nomor urut dan kode SK baru untuk tahun berjalan.
     *
     * @return array
     */
    public function generateSk(): array
    {
        $tahun = Carbon::now()->year;
        $latestSk = Sk::where('tahun', $tahun)->latest('no_urut')->first();

        $noUrut = $latestSk ? $latestSk->no_urut + 1 : 1;
        $kodeSk = 'SK' . str_pad($noUrut, 4, '0', STR_PAD_LEFT);

        return [
            'no_urut' => $noUrut,
            'kode_sk' => $kodeSk,
        ];
    }

    /**
     * Generate nomor urut dan kode PB baru untuk tahun berjalan.
     *
     * @return array
     */
    public function generatePb(): array
    {
        $tahun = Carbon::now()->year;
        $latestPb = Pb::where('tahun', $tahun)->latest('no_urut')->first();

        $noUrut = $latestPb ? $latestPb->no_urut + 1 : 1;
        $kodePb = 'PB' . str_pad($noUrut, 4, '0', STR_PAD_LEFT);

        return [
            'no_urut' => $noUrut,
            'kode_pb' => $kodePb,
        ];
    }

    /**
     * Generate nomor urut dan kode Lain baru untuk tahun berjalan.
     *
     * @return array
     */
    public function generateLain(): array
    {
        $tahun = Carbon::now()->year;
        $latestLain = Lain::where('tahun', $tahun)->latest('no_urut')->first();

        $noUrut = $latestLain ? $latestLain->no_urut + 1 : 1;
        $kodeLain = 'L' . str_pad($noUrut, 4, '0', STR_PAD_LEFT);

        return [
            'no_urut' => $noUrut,
            'kode_lain' => $kodeLain,
        ];
    }
}