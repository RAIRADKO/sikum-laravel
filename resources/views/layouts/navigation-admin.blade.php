<div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

<div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-800 lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex items-center justify-center mt-8">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <x-application-logo class="block h-10 w-auto fill-current text-white" />
            <span class="text-white text-2xl mx-2 font-semibold">SIKUM</span>
        </a>
    </div>

    <nav class="mt-10">
        <x-nav-link-sidebar :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Dashboard') }}
        </x-nav-link-sidebar>

        <h3 class="px-6 text-xs text-gray-400 uppercase tracking-wider mt-4">Pengajuan</h3>
        <x-nav-link-sidebar :href="route('sk.index')" :active="request()->routeIs('sk.*')">
            {{ __('Data SK') }}
        </x-nav-link-sidebar>
        <x-nav-link-sidebar :href="route('pb.index')" :active="request()->routeIs('pb.*')">
            {{ __('Data PB') }}
        </x-nav-link-sidebar>
        <x-nav-link-sidebar :href="route('lain.index')" :active="request()->routeIs('lain.*')">
            {{ __('Produk Lain') }}
        </x-nav-link-sidebar>

        @if(Auth::user()->level == 'admin')
        <h3 class="px-6 text-xs text-gray-400 uppercase tracking-wider mt-4">Master Data</h3>
        <x-nav-link-sidebar :href="route('opd.index')" :active="request()->routeIs('opd.*')">
            {{ __('Master OPD') }}
        </x-nav-link-sidebar>
        <x-nav-link-sidebar :href="route('assistants.index')" :active="request()->routeIs('assistants.*')">
            {{ __('Master Asisten') }}
        </x-nav-link-sidebar>
        @endif
    </nav>
</div>