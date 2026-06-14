<x-guest-layout>
    <div class="space-y-6">
        <div class="flex justify-start">
            <a href="{{ url('/') }}" class="inline-flex items-center space-x-1 text-xs font-bold text-slate-400 hover:text-blue-600 transition group">
                <span class="inline-block transition-transform duration-150 transform group-hover:-translate-x-1">←</span>
                <span>Kembali ke Beranda</span>
            </a>
        </div>

        <div class="text-center space-y-2">
            <div class="inline-flex h-12 w-12 bg-blue-600 rounded-2xl items-center justify-center shadow-lg shadow-blue-500/20 mb-2">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <h2 class="font-extrabold text-2xl text-slate-800 tracking-tight">Selamat Datang</h2>
            <p class="text-xs text-slate-400 font-medium">Masuk untuk mengakses layanan akademik SIAKAD UNSUR.</p>
        </div>

        @if (session('status'))
            <div class="bg-blue-50 border border-blue-100 text-blue-700 px-4 py-3 rounded-xl text-xs font-semibold">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">{{ __('Alamat Email') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="nama@student.unsur.ac.id"
                       class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 placeholder-slate-300 font-medium text-slate-800 @error('email') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                @error('email')
                    <p class="text-red-500 text-xs font-medium mt-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-1.5">
                <div class="flex justify-between items-center">
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">{{ __('Kata Sandi') }}</label>
                    @if (Route::has('password.request'))
                        <a class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition" href="{{ route('password.request') }}">
                            {{ __('Lupa sandi?') }}
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       placeholder="••••••••"
                       class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 text-slate-800 @error('password') border-red-300 focus:border-red-500 focus:ring-red-200 @enderror">
                @error('password')
                    <p class="text-red-500 text-xs font-medium mt-1">⚠️ {{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                    <input id="remember_me" type="checkbox" name="remember" 
                           class="rounded-lg border-slate-200 text-blue-600 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 h-4 w-4 transition duration-150">
                    <span class="ms-2 text-xs font-semibold text-slate-500 hover:text-slate-700 transition">{{ __('Ingat sesi saya') }}</span>
                </label>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-5 rounded-xl text-sm transition duration-150 shadow-md shadow-blue-500/10">
                    {{ __('Masuk ke Akun') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>