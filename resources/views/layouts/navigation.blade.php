<nav x-data="{ open: false }" class="w-full bg-ghooo-50/80 backdrop-blur-md border-b border-ghooo-200 py-4 fixed top-0 z-50 transition-all duration-300">
    <div class="max-w-[1600px] mx-auto px-6 w-full">
        <div class="flex justify-between items-center">
            
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="text-2xl font-black font-outfit text-ghooo-950 tracking-tight flex items-center gap-2">
                    <span class="material-symbols-outlined text-ghooo-600">book</span>
                    Ghooo<span class="text-ghooo-500 font-normal italic">Library</span>
                </a>
            </div>
            
            <!-- Primary Navigation Menu (Center) -->
            <div class="hidden md:flex items-center justify-center gap-10 font-outfit text-[13px] font-semibold tracking-widest uppercase text-ghooo-600">
                <a href="{{ route('home') }}" class="hover:text-ghooo-900 transition-colors relative group {{ request()->routeIs('home') ? 'text-ghooo-950' : '' }}">
                    Home
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-ghooo-500 transition-all group-hover:w-full {{ request()->routeIs('home') ? 'w-full' : '' }}"></span>
                </a>
                <a href="{{ route('collections') }}" class="hover:text-ghooo-900 transition-colors relative group {{ request()->routeIs('collections') ? 'text-ghooo-950' : '' }}">
                    Collections
                    <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-ghooo-500 transition-all group-hover:w-full {{ request()->routeIs('collections') ? 'w-full' : '' }}"></span>
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-ghooo-900 transition-colors relative group {{ request()->routeIs('dashboard') ? 'text-ghooo-950' : '' }}">
                        My Shelf
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-ghooo-500 transition-all group-hover:w-full {{ request()->routeIs('dashboard') ? 'w-full' : '' }}"></span>
                    </a>
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-ghooo-900 transition-colors relative group {{ request()->routeIs('admin.dashboard') ? 'text-ghooo-950' : '' }}">
                            Admin
                            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-ghooo-500 transition-all group-hover:w-full {{ request()->routeIs('admin.dashboard') ? 'w-full' : '' }}"></span>
                        </a>
                    @endif
                @endauth
            </div>

            <!-- Right Side Auth / Profile -->
            <div class="hidden md:flex items-center gap-6">
                @auth
                    <!-- Settings Dropdown -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-3 text-ghooo-700 hover:text-ghooo-950 transition-colors focus:outline-none py-2 font-outfit text-sm font-semibold bg-ghooo-100 px-4 rounded-full border border-ghooo-200">
                                <div class="w-6 h-6 rounded-full bg-ghooo-300 flex items-center justify-center text-[10px] text-ghooo-800 uppercase font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <span class="material-symbols-outlined text-[18px]">expand_more</span>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="font-outfit text-sm">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();" class="font-outfit text-sm text-red-600 hover:bg-red-50">
                                    {{ __('Log out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-ghooo-800 font-outfit text-xs font-bold uppercase tracking-wider hover:text-ghooo-950 transition-colors">Log in</a>
                    <a href="{{ route('register') }}" class="px-7 py-3 bg-ghooo-900 text-ghooo-50 rounded-full font-outfit text-xs font-bold uppercase tracking-wider hover:bg-ghooo-950 transition-all shadow-lg hover:-translate-y-0.5">Join Now</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="flex items-center md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-ghooo-900 hover:bg-ghooo-100 rounded-full focus:outline-none transition duration-150 ease-in-out border border-ghooo-200">
                    <span class="material-symbols-outlined text-[24px]" x-show="!open">menu</span>
                    <span class="material-symbols-outlined text-[24px]" x-show="open" x-cloak>close</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-white/95 backdrop-blur-xl border-t border-ghooo-200 absolute top-full left-0 w-full shadow-2xl overflow-hidden" x-cloak>
        <div class="pt-6 pb-6 space-y-2 font-outfit px-6">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="rounded-xl">
                {{ __('Home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('collections')" :active="request()->routeIs('collections')" class="rounded-xl">
                {{ __('Collections') }}
            </x-responsive-nav-link>
            
            @auth
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-xl">
                    {{ __('My Shelf') }}
                </x-responsive-nav-link>

                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="rounded-xl">
                        {{ __('Admin Panel') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        @auth
        <div class="pt-4 pb-6 border-t border-ghooo-100 font-outfit px-6 bg-ghooo-50/50">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-full bg-ghooo-200 flex items-center justify-center text-ghooo-600 font-bold text-xl uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-lg text-ghooo-900">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-ghooo-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center justify-center py-3 bg-white border border-ghooo-200 rounded-xl text-ghooo-800 font-bold text-sm">
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center py-3 bg-red-50 text-red-600 rounded-xl font-bold text-sm">
                        Log out
                    </button>
                </form>
            </div>
        </div>
        @else
        <div class="p-6 grid grid-cols-1 gap-4 border-t border-ghooo-100 font-outfit">
            <a href="{{ route('register') }}" class="text-center py-4 bg-ghooo-900 text-ghooo-50 font-bold uppercase text-xs tracking-widest rounded-xl shadow-lg">Create Account</a>
            <a href="{{ route('login') }}" class="text-center py-4 border border-ghooo-300 text-ghooo-900 font-bold uppercase text-xs tracking-widest rounded-xl">Sign In</a>
        </div>
        @endauth
    </div>
</nav>