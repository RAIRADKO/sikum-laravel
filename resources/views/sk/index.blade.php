@extends('layouts.admin')

@section('title', 'Data Surat Keputusan')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Data Pengajuan Surat Keputusan (SK)</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Kode SK</th>
                    <th class="py-2 px-4 border-b">Perihal</th>
                    <th class="py-2 px-4 border-b">OPD Pemohon</th>
                    <th class="py-2 px-4 border-b">Tgl. Pengajuan</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sks as $sk)
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="py-2 px-4 border-b">{{ $loop->iteration + $sks->firstItem() - 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $sk->kode_sk }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $sk->perihal }}</td>
                        <td class="py-2 px-4 border-b">{{ $sk->opd->nama_opd }}</td>
                        <td class="py-2 px-4 border-b">{{ $sk->tgl_pengajuan->format('d M Y') }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($sk->status == 'Proses') bg-yellow-100 text-yellow-800 
                                @elseif($sk->status == 'Selesai') bg-green-100 text-green-800 
                                @else bg-red-100 text-red-800 @endif">
                                {{ $sk->status }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('sk.show', $sk->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 border-b text-center">Tidak ada data pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $sks->links() }}
    </div>
@endsection