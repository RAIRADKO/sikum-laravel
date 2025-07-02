{{-- Tentukan layout berdasarkan peran user --}}
@extends(Auth::user()->level == 'user' ? 'layouts.user' : 'layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-800">Selamat Datang, {{ Auth::user()->nama }}!</h2>
        <p class="mt-2 text-gray-600">
            Anda login sebagai {{ ucfirst(Auth::user()->level) }}.
            @if(Auth::user()->level == 'user')
                Anda dari {{ Auth::user()->opd->nama_opd ?? 'OPD tidak terdaftar' }}.
            @endif
        </p>

        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-700">Status Sistem</h3>
            <p class="mt-1 text-gray-500">
                Ini adalah halaman utama Anda. Silakan gunakan menu navigasi untuk mengakses fitur lainnya.
            </p>
            {{-- Di sini Anda bisa menambahkan kartu-kartu statistik --}}
        </div>
    </div>
@endsection