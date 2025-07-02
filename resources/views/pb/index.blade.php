@extends('layouts.admin')

@section('title', 'Data Peraturan Bupati')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Data Pengajuan Peraturan Bupati (PB)</h1>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Kode PB</th>
                    <th class="py-2 px-4 border-b">Perihal</th>
                    <th class="py-2 px-4 border-b">OPD Pemohon</th>
                    <th class="py-2 px-4 border-b">Tgl. Pengajuan</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pbs as $pb)
                    <tr class="hover:bg-gray-50 text-center">
                        <td class="py-2 px-4 border-b">{{ $loop->iteration + $pbs->firstItem() - 1 }}</td>
                        <td class="py-2 px-4 border-b">{{ $pb->kode_pb }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $pb->perihal }}</td>
                        <td class="py-2 px-4 border-b">{{ $pb->opd->nama_opd }}</td>
                        <td class="py-2 px-4 border-b">{{ $pb->tgl_pengajuan->format('d M Y') }}</td>
                        <td class="py-2 px-4 border-b">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($pb->status == 'Proses') bg-yellow-100 text-yellow-800 
                                @elseif($pb->status == 'Selesai') bg-green-100 text-green-800 
                                @else bg-red-100 text-red-800 @endif">
                                {{ $pb->status }}
                            </span>
                        </td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('pb.show', $pb->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
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
        {{ $pbs->links() }}
    </div>
@endsection