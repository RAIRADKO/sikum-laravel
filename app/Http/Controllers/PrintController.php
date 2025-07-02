<?php

namespace App\Http\Controllers;

use App\Models\Sk;
use App\Models\Pb;
use Barryvdh\DomPDF\Facade\Pdf; // Asumsi menggunakan laravel-dompdf

class PrintController extends Controller
{
    // Mencetak Kartu Kendali SK (dari kartunosk.php)
    public function skCard(Sk $sk)
    {
        // return view('prints.sk_kartu', compact('sk')); // Untuk melihat versi HTML
        $pdf = Pdf::loadView('prints.sk_kartu', compact('sk'));
        return $pdf->stream('kartu-kendali-sk-' . $sk->kode_sk . '.pdf');
    }
    
    // Mencetak Kartu Kendali PB (dari cetaknopb.php)
    public function pbCard(Pb $pb)
    {
        $pdf = Pdf::loadView('prints.pb_kartu', compact('pb'));
        return $pdf->stream('kartu-kendali-pb-' . $pb->kode_pb . '.pdf');
    }

    // Mencetak Tanda Terima (dari cetaktandaterima.php)
    public function receipt(Sk $sk) // Bisa juga untuk PB/Lain
    {
        $pdf = Pdf::loadView('prints.tanda_terima', compact('sk'));
        return $pdf->stream('tanda-terima-' . $sk->kode_sk . '.pdf');
    }
}