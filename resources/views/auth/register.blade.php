<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold font-outfit text-white mb-2">Buat Akun Baru</h2>
        <p class="text-sm text-slate-300 font-medium">Bergabunglah dengan Ghooo Library sekarang.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-outfit text-sm font-medium text-slate-300 mb-2">Nama Lengkap</label>
            <input id="name" class="block w-full bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:border-accent focus:ring focus:ring-accent/30 transition-all px-4 py-3 outline-none" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Masukkan nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-accent-light" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-outfit text-sm font-medium text-slate-300 mb-2">Email</label>
            <input id="email" class="block w-full bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:border-accent focus:ring focus:ring-accent/30 transition-all px-4 py-3 outline-none" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Masukkan email Anda" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-accent-light" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block font-outfit text-sm font-medium text-slate-300 mb-2">Kata Sandi</label>
            <input id="password" class="block w-full bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:border-accent focus:ring focus:ring-accent/30 transition-all px-4 py-3 outline-none"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Buat kata sandi yang kuat" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-accent-light" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block font-outfit text-sm font-medium text-slate-300 mb-2">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" class="block w-full bg-white/10 border border-white/20 rounded-xl text-white placeholder-slate-400 focus:border-accent focus:ring focus:ring-accent/30 transition-all px-4 py-3 outline-none"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-accent-light" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-gradient-to-r from-ghooo-500 to-accent text-white font-outfit font-bold py-3.5 rounded-xl shadow-lg hover:shadow-accent/30 hover:-translate-y-0.5 transition-all duration-300">
                Daftar Sekarang
            </button>
        </div>
        
        <div class="text-center mt-6">
            <p class="text-sm text-slate-400">Sudah memiliki akun? <a href="{{ route('login') }}" class="text-accent hover:text-accent-light font-medium hover:underline transition-colors">Masuk di sini</a></p>
        </div>
    </form>
</x-guest-layout>
