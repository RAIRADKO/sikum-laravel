<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sk;
use Barryvdh\DomPDF\Facade\Pdf; // Asumsi menggunakan laravel-dompdf
use App\Exports\SkExport; // Asumsi menggunakan maatwebsite/excel
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Menampilkan form untuk filter laporan.
     */
    public function skReportForm()
    {
        return view('reports.sk_form');
    }

    /**
     * Generate laporan SK berdasarkan filter.
     * Logika dari excellapnosk.php & cetaklapnosk.php
     */
    public function generateSkReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'format' => 'required|in:pdf,excel',
        ]);

        $sks = Sk::whereBetween('tgl_pengajuan', [$request->start_date, $request->end_date])->get();
        
        if ($request->format == 'pdf') {
            $pdf = Pdf::loadView('reports.sk_report_pdf', compact('sks'));
            return $pdf->download('laporan-sk.pdf');
        }

        if ($request->format == 'excel') {
            return Excel::download(new SkExport($sks), 'laporan-sk.xlsx');
        }
    }
    
    // Tambahkan metode serupa untuk laporan PB dan Lainnya
}