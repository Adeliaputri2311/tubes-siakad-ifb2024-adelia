<section class="space-y-6">
    <header>
        <h3 class="text-lg font-bold text-slate-800 tracking-tight">
            {{ __('Perbarui Kata Sandi') }}
        </h3>
        <p class="text-xs text-slate-400 font-medium mt-1">
            {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk menjaga keamanan data akademik.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="space-y-1.5">
            <label for="update_password_current_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">{{ __('Kata Sandi Saat Ini') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                   class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 {{ $errors->updatePassword->has('current_password') ? 'border-red-300 focus:border-red-500 focus:ring-red-200' : '' }}">
            @if($errors->updatePassword->has('current_password'))
                <p class="text-red-500 text-xs font-medium mt-1">⚠️ {{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <div class="space-y-1.5">
            <label for="update_password_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">{{ __('Kata Sandi Baru') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                   class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 {{ $errors->updatePassword->has('password') ? 'border-red-300 focus:border-red-500 focus:ring-red-200' : '' }}">
            @if($errors->updatePassword->has('password'))
                <p class="text-red-500 text-xs font-medium mt-1">⚠️ {{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <div class="space-y-1.5">
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">{{ __('Konfirmasi Kata Sandi Baru') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                   class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 {{ $errors->updatePassword->has('password_confirmation') ? 'border-red-300 focus:border-red-500 focus:ring-red-200' : '' }}">
            @if($errors->updatePassword->has('password_confirmation'))
                <p class="text-red-500 text-xs font-medium mt-1">⚠️ {{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <div class="flex items-center space-x-4 pt-4 border-t border-slate-100">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10">
                {{ __('Perbarui Sandi') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
                   class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100/50">
                    ✨ {{ __('Sandi Berhasil Diubah.') }}
                </p>
            @endif
        </div>
    </form>
</section>