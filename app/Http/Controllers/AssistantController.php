<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use Illuminate\Http\Request;

class AssistantController extends Controller
{
    public function index()
    {
        $assistants = Assistant::latest()->paginate(10);
        return view('assistants.index', compact('assistants'));
    }

    public function create()
    {
        return view('assistants.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|unique:assistants,nip',
        ]);

        Assistant::create($request->all());

        return redirect()->route('assistants.index')->with('success', 'Data Asisten berhasil ditambahkan.');
    }

    public function edit(Assistant $assistant)
    {
        return view('assistants.edit', compact('assistant'));
    }

    public function update(Request $request, Assistant $assistant)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|unique:assistants,nip,' . $assistant->id,
        ]);

        $assistant->update($request->all());

        return redirect()->route('assistants.index')->with('success', 'Data Asisten berhasil diperbarui.');
    }

    public function destroy(Assistant $assistant)
    {
        $assistant->delete();
        return redirect()->route('assistants.index')->with('success', 'Data Asisten berhasil dihapus.');
    }
}