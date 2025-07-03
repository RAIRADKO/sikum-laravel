<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:flex-row">
        <div class="flex flex-col justify-center items-center w-full sm:w-1/2 bg-white p-6">
            <div class="w-full sm:max-w-md">
                <div class="mb-8 text-center">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500 mx-auto" />
                    </a>
                    <h1 class="text-2xl font-bold mt-4 text-gray-800">Selamat Datang di SIKUM</h1>
                    <p class="text-gray-500">Sistem Informasi Hukum</p>
                </div>
                {{ $slot }}
            </div>
        </div>

        <div class="hidden sm:flex w-1/2 bg-gray-800 items-center justify-center p-12">
            <div class="text-white text-center">
                {{-- Anda bisa menaruh gambar di sini --}}
                {{-- <img src="{{ asset('images/logo-instansi.png') }}" alt="Logo Instansi" class="w-48 mx-auto mb-4"> --}}
                <h2 class="text-4xl font-bold">Transparansi dan Efisiensi</h2>
                <p class="mt-2 text-lg text-gray-300">Mengelola produk hukum menjadi lebih mudah dan terpusat.</p>
            </div>
        </div>
    </div>
</body>
</html>