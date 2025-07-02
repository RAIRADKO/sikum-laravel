@extends(Auth::user()->level == 'user' ? 'layouts.user' : 'layouts.admin')

@section('title', 'Detail Proses SK')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Detail Pengajuan: {{ $sk->kode_sk }}</h1>

    {{-- Informasi Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div><strong>Perihal:</strong> {{ $sk->perihal }}</div>
        <div><strong>OPD:</strong> {{ $sk->opd->nama_opd }}</div>
        <div><strong>Pemohon:</strong> {{ $sk->pemohon }}</div>
        <div><strong>Tgl. Pengajuan:</strong> {{ $sk->tgl_pengajuan->format('d M Y') }}</div>
        <div><strong>Status:</strong> <span class="font-bold">{{ $sk->status }}</span></div>
        @if($sk->no_sk)
        <div><strong>No. SK Final:</strong> <span class="font-bold">{{ $sk->no_sk }}</span></div>
        @endif
    </div>

    {{-- Timeline Proses --}}
    <h2 class="text-xl font-semibold mb-4">Alur Proses</h2>
    <ol class="relative border-s border-gray-200">
        @for ($i = 1; $i <= 6; $i++)
            @php
                $tahap = 'tahap' . $i;
                $ket = 'ket' . $i;
                $isCompleted = !is_null($sk->$tahap);
            @endphp
            <li class="mb-10 ms-4">
                <div class="absolute w-3 h-3 rounded-full mt-1.5 -start-1.5 border border-white {{ $isCompleted ? 'bg-green-500' : 'bg-gray-400' }}"></div>
                <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $isCompleted ? $sk->$tahap->format('d M Y, H:i') : 'Belum Selesai' }}</time>
                <h3 class="text-lg font-semibold text-gray-900">{{ config('sikum.tahapan_sk.' . $i) }}</h3> {{-- (Buat file config untuk nama tahapan) --}}
                <p class="text-base font-normal text-gray-600">{{ $sk->$ket ?? 'Menunggu proses...' }}</p>
            </li>
        @endfor
    </ol>
    
    {{-- Form Aksi untuk Admin/UserHukum --}}
    @if(in_array(Auth::user()->level, ['admin', 'userhukum']) && $sk->status == 'Proses')
        <hr class="my-6">
        <h2 class="text-xl font-semibold mb-4">Update Proses Selanjutnya</h2>
        <form action="{{ route('sk.process.update', $sk->id) }}" method="POST">
             @csrf
            {{-- Logika untuk menentukan tahap selanjutnya --}}
            @php $next_tahap = 1; foreach (range(1, 6) as $t) { if(is_null($sk->{'tahap'.$t})) { $next_tahap = $t; break; } } @endphp

            <input type="hidden" name="tahap" value="{{ $next_tahap }}">
            <div>
                <label class="block text-sm font-medium text-gray-700">Update untuk: <strong>{{ config('sikum.tahapan_sk.' . $next_tahap) }}</strong></label>
                <textarea name="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Masukkan keterangan/catatan..."></textarea>
            </div>
             @if($next_tahap == 6)
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Nomor SK Final</label>
                    <input type="text" name="no_sk_final" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Contoh: 188.45/123/2025" required>
                </div>
            @endif
            <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                Update ke Tahap {{ $next_tahap }}
            </button>
        </form>
    @endif
@endsection