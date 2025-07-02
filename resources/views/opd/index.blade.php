@extends('layouts.admin')

@section('title', 'Data Master OPD')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Data Master OPD</h1>
        <a href="{{ route('opd.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
            Tambah OPD
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Nama OPD</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($opds as $opd)
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="py-2 px-4 border-b">{{ $loop->iteration + $opds->firstItem() - 1 }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $opd->nama_opd }}</td>
                        <td class="py-2 px-4 border-b">{{ ucfirst($opd->status) }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('opd.edit', $opd->id_opd) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                            <form action="{{ route('opd.destroy', $opd->id_opd) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus OPD ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 border-b text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $opds->links() }}
    </div>
@endsection