<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('sk.index')" :active="request()->routeIs('sk.*')">
                        {{ __('Data SK') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pb.index')" :active="request()->routeIs('pb.*')">
                        {{ __('Data PB') }}
                    </x-nav-link>
                    <x-nav-link :href="route('lain.index')" :active="request()->routeIs('lain.*')">
                        {{ __('Produk Lain') }}
                    </x-nav-link>

                    @if(Auth::user()->level == 'admin')
                    <x-nav-link :href="route('opd.index')" :active="request()->routeIs('opd.*')">
                        {{ __('Master OPD') }}
                    </x-nav-link>
                    <x-nav-link :href="route('assistants.index')" :active="request()->routeIs('assistants.*')">
                        {{ __('Master Asisten') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>
            
            </div>
    </div>
</nav>