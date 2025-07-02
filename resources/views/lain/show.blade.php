@extends(Auth::user()->level == 'user' ? 'layouts.user' : 'layouts.admin')

@section('title', 'Detail Proses Produk Lain')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Detail Pengajuan: {{ $lain->kode_lain }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div><strong>Perihal:</strong> {{ $lain->perihal }}</div>
        <div><strong>OPD:</strong> {{ $lain->opd->nama_opd }}</div>
        <div><strong>Pemohon:</strong> {{ $lain->pemohon }}</div>
        <div><strong>Tgl. Pengajuan:</strong> {{ $lain->tgl_pengajuan->format('d M Y') }}</div>
        <div><strong>Status:</strong> <span class="font-bold">{{ $lain->status }}</span></div>
        @if($lain->no_lain)
        <div><strong>No. Final:</strong> <span class="font-bold">{{ $lain->no_lain }}</span></div>
        @endif
    </div>

    <h2 class="text-xl font-semibold mb-4">Alur Proses</h2>
    <ol class="relative border-s border-gray-200">
        {{-- Sesuaikan jumlah tahapan dengan migrasi 'lains' --}}
        @for ($i = 1; $i <= 1; $i++) 
            @php
                $tahap = 'tahap' . $i;
                $ket = 'ket' . $i;
                $isCompleted = !is_null($lain->$tahap);
            @endphp
            <li class="mb-10 ms-4">
                <div class="absolute w-3 h-3 rounded-full mt-1.5 -start-1.5 border border-white {{ $isCompleted ? 'bg-green-500' : 'bg-gray-400' }}"></div>
                <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $isCompleted ? $lain->$tahap->format('d M Y, H:i') : 'Belum Selesai' }}</time>
                <h3 class="text-lg font-semibold text-gray-900">Tahap {{ $i }} : Pengajuan</h3>
                <p class="text-base font-normal text-gray-600">{{ $lain->$ket ?? 'Menunggu proses...' }}</p>
            </li>
        @endfor
    </ol>
    
    {{-- Karena alurnya sederhana, form update bisa dibuat lebih simpel atau ditiadakan --}}
    {{-- Contoh jika ada proses "Selesai" manual --}}
    @if(in_array(Auth::user()->level, ['admin', 'userhukum']) && $lain->status == 'Proses')
        <hr class="my-6">
        <h2 class="text-xl font-semibold mb-4">Update Status</h2>
        <form action="{{ route('lain.process.update', $lain->id) }}" method="POST">
             @csrf
            <input type="hidden" name="tahap" value="2"> {{-- Anggap 2 adalah status selesai --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Keterangan/Catatan</label>
                <textarea name="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Masukkan keterangan..."></textarea>
            </div>
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Nomor Final (Jika ada)</label>
                <input type="text" name="no_lain_final" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500">
                Tandai Sebagai Selesai
            </button>
        </form>
    @endif
@endsection