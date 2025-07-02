<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    // Menampilkan daftar semua OPD
    public function index()
    {
        $opds = Opd::latest()->paginate(10);
        return view('opd.index', compact('opds'));
    }

    // Menampilkan form untuk membuat OPD baru
    public function create()
    {
        return view('opd.create');
    }

    // Menyimpan OPD baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_opd' => 'required|string|unique:opds,nama_opd',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Opd::create($request->all());

        return redirect()->route('opd.index')->with('success', 'Data OPD berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit OPD
    public function edit(Opd $opd)
    {
        return view('opd.edit', compact('opd'));
    }

    // Memperbarui data OPD
    public function update(Request $request, Opd $opd)
    {
        $request->validate([
            'nama_opd' => 'required|string|unique:opds,nama_opd,' . $opd->id_opd . ',id_opd',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $opd->update($request->all());

        return redirect()->route('opd.index')->with('success', 'Data OPD berhasil diperbarui.');
    }

    // Menghapus data OPD
    public function destroy(Opd $opd)
    {
        // Tambahkan validasi, misal OPD tidak bisa dihapus jika masih memiliki user atau berkas
        if ($opd->users()->count() > 0 || $opd->sks()->count() > 0) {
            return back()->with('error', 'OPD tidak dapat dihapus karena masih memiliki data terkait.');
        }

        $opd->delete();
        return redirect()->route('opd.index')->with('success', 'Data OPD berhasil dihapus.');
    }
}