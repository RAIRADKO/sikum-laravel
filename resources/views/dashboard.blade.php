{{-- Tentukan layout berdasarkan peran user --}}
@extends(Auth::user()->level == 'user' ? 'layouts.user' : 'layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->nama }}!</h2>
        <p class="mt-2 text-gray-600">
            Anda login sebagai <span class="font-semibold">{{ ucfirst(Auth::user()->level) }}</span>.
            @if(Auth::user()->level == 'user')
                Anda dari OPD: <span class="font-semibold">{{ Auth::user()->opd->nama_opd ?? 'OPD tidak terdaftar' }}</span>.
            @endif
        </p>
    </div>

    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Total Pengajuan SK</span>
                <p class="text-3xl font-bold text-gray-800">{{--
                    Placeholder untuk jumlah, perlu diimplementasikan di controller
                    --}} 99</p> 
            </div>
            <div class="bg-blue-500 text-white p-3 rounded-full">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <span class="text-sm font-medium text-gray-500">Total Pengajuan PB</span>
                <p class="text-3xl font-bold text-gray-800">{{-- Placeholder --}} 50</p>
            </div>
             <div class="bg-green-500 text-white p-3 rounded-full">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m-1 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3h2m-4 3h2m-4 3h2"></path></svg>
            </div>
        </div>
        {{-- Tambahkan kartu lain jika perlu --}}
    </div>
    
    <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-medium text-gray-700">Aktivitas Terbaru</h3>
        <p class="mt-1 text-gray-500">
           Di sini Anda dapat menampilkan daftar pengajuan terakhir atau notifikasi penting.
        </p>
    </div>
@endsection