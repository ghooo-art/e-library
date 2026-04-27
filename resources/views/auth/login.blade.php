<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold font-outfit text-white mb-2">Selamat Datang Kembali</h2>
        <p class="text-sm text-slate-300 font-medium">Masuk untuk melanjutkan membaca.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-outfit text-sm font-medium text-slate-300 mb-2">Email</label>
            <input id="email" class="block w-full bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:border-accent focus:ring focus:ring-accent/30 transition-all px-4 py-3 outline-none" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-accent-light" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block font-outfit text-sm font-medium text-slate-300">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-accent hover:text-accent-light hover:underline transition-colors font-medium" href="{{ route('password.request') }}">
                        Lupa Sandi?
                    </a>
                @endif
            </div>
            <input id="password" class="block w-full bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:border-accent focus:ring focus:ring-accent/30 transition-all px-4 py-3 outline-none"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Masukkan kata sandi" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-accent-light" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-white/30 bg-white/10 text-accent shadow-sm focus:ring-accent focus:ring-offset-0" name="remember">
                <span class="ms-2 text-sm text-slate-300 group-hover:text-white transition-colors">Ingat Saya</span>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full bg-gradient-to-r from-ghooo-500 to-accent text-white font-outfit font-bold py-3.5 rounded-xl shadow-lg hover:shadow-accent/30 hover:-translate-y-0.5 transition-all duration-300">
                Masuk Sekarang
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-sm text-slate-400">Belum punya akun? <a href="{{ route('register') }}" class="text-accent hover:text-accent-light font-medium hover:underline transition-colors">Daftar di sini</a></p>
        </div>
    </form>
</x-guest-layout>
