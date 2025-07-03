@extends('layouts.admin')

@section('title', 'Edit OPD')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Formulir Edit OPD</h1>
    
    <form action="{{ route('opd.update', $opd->id_opd) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="space-y-4 max-w-lg">
            <div>
                <label for="nama_opd" class="block text-sm font-medium text-gray-700">Nama OPD</label>
                <input type="text" id="nama_opd" name="nama_opd" value="{{ old('nama_opd', $opd->nama_opd) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    <option value="aktif" @selected(old('status', $opd->status) == 'aktif')>Aktif</option>
                    <option value="tidak aktif" @selected(old('status', $opd->status) == 'tidak aktif')>Tidak Aktif</option>
                </select>
            </div>
            
            <div class="flex items-center gap-4">
                <x-primary-button>
                    {{ __('Update') }}
                </x-primary-button>
                
                <a href="{{ route('opd.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Batal
                </a>
            </div>
        </div>
    </form>
@endsection