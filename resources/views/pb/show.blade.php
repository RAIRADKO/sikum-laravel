@extends(Auth::user()->level == 'user' ? 'layouts.user' : 'layouts.admin')

@section('title', 'Detail Proses PB')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Detail Pengajuan: {{ $pb->kode_pb }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div><strong>Perihal:</strong> {{ $pb->perihal }}</div>
        <div><strong>OPD:</strong> {{ $pb->opd->nama_opd }}</div>
        <div><strong>Pemohon:</strong> {{ $pb->pemohon }}</div>
        <div><strong>Tgl. Pengajuan:</strong> {{ $pb->tgl_pengajuan->format('d M Y') }}</div>
        <div><strong>Status:</strong> <span class="font-bold">{{ $pb->status }}</span></div>
        @if($pb->no_pb)
        <div><strong>No. PB Final:</strong> <span class="font-bold">{{ $pb->no_pb }}</span></div>
        @endif
    </div>

    <h2 class="text-xl font-semibold mb-4">Alur Proses</h2>
    <ol class="relative border-s border-gray-200">
        {{-- Sesuaikan jumlah tahapan dengan migrasi PB --}}
        @for ($i = 1; $i <= 2; $i++) 
            @php
                $tahap = 'tahap' . $i;
                $ket = 'ket' . $i;
                $isCompleted = !is_null($pb->$tahap);
            @endphp
            <li class="mb-10 ms-4">
                <div class="absolute w-3 h-3 rounded-full mt-1.5 -start-1.5 border border-white {{ $isCompleted ? 'bg-green-500' : 'bg-gray-400' }}"></div>
                <time class="mb-1 text-sm font-normal leading-none text-gray-500">{{ $isCompleted ? $pb->$tahap->format('d M Y, H:i') : 'Belum Selesai' }}</time>
                <h3 class="text-lg font-semibold text-gray-900">Tahap {{ $i }}</h3>
                <p class="text-base font-normal text-gray-600">{{ $pb->$ket ?? 'Menunggu proses...' }}</p>
            </li>
        @endfor
    </ol>
    
    @if(in_array(Auth::user()->level, ['admin', 'userhukum']) && $pb->status == 'Proses')
        <hr class="my-6">
        <h2 class="text-xl font-semibold mb-4">Update Proses Selanjutnya</h2>
        <form action="{{ route('pb.process.update', $pb->id) }}" method="POST">
             @csrf
            @php $next_tahap = 1; foreach (range(1, 2) as $t) { if(is_null($pb->{'tahap'.$t})) { $next_tahap = $t; break; } } @endphp

            <input type="hidden" name="tahap" value="{{ $next_tahap }}">
            <div>
                <label class="block text-sm font-medium text-gray-700">Update untuk: <strong>Tahap {{ $next_tahap }}</strong></label>
                <textarea name="keterangan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required placeholder="Masukkan keterangan/catatan..."></textarea>
            </div>
             @if($next_tahap == 2) {{-- Anggap tahap 2 adalah tahap terakhir --}}
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Nomor PB Final</label>
                    <input type="text" name="no_pb_final" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                </div>
            @endif
            <button type="submit" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500">
                Update ke Tahap {{ $next_tahap }}
            </button>
        </form>
    @endif
@endsection