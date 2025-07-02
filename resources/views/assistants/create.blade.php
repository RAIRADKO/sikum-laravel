@extends('layouts.admin')

@section('title', 'Tambah Asisten Baru')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Formulir Tambah Asisten Baru</h1>
    
    <form action="{{ route('assistants.store') }}" method="POST">
        @csrf
        <div class="space-y-4 max-w-lg">
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Asisten</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label for="nip" class="block text-sm font-medium text-gray-700">NIP (Opsional)</label>
                <input type="text" id="nip" name="nip" value="{{ old('nip') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            
            <div class="flex justify-start">
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Simpan
                </button>
                 <a href="{{ route('assistants.index') }}" class="ml-2 inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Batal
                </a>
            </div>
        </div>
    </form>
@endsection