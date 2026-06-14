<section class="space-y-6">
    <header>
        <h3 class="text-lg font-bold text-slate-800 tracking-tight">
            {{ __('Informasi Profil') }}
        </h3>
        <p class="text-xs text-slate-400 font-medium mt-1">
            {{ __("Perbarui informasi nama akun dan alamat email utama Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="space-y-1.5">
            <label for="profile_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">{{ __('Nama Lengkap') }}</label>
            <input id="profile_name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 text-slate-800 font-medium {{ $errors->updateProfileInformation->has('name') ? 'border-red-300 focus:border-red-500 focus:ring-red-200' : '' }}">
            @if($errors->updateProfileInformation->has('name'))
                <p class="text-red-500 text-xs font-medium mt-1">⚠️ {{ $errors->updateProfileInformation->first('name') }}</p>
            @endif
        </div>

        <div class="space-y-1.5">
            <label for="profile_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">{{ __('Alamat Email') }}</label>
            <input id="profile_email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                   class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 text-sm px-4 py-3 text-slate-800 font-medium {{ $errors->updateProfileInformation->has('email') ? 'border-red-300 focus:border-red-500 focus:ring-red-200' : '' }}">
            @if($errors->updateProfileInformation->has('email'))
                <p class="text-red-500 text-xs font-medium mt-1">⚠️ {{ $errors->updateProfileInformation->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 bg-amber-50 p-3 rounded-xl border border-amber-100 text-xs text-amber-700">
                    <p class="font-medium">
                        {{ __('Alamat email Anda belum terverifikasi.') }}
                        <button form="send-verification" class="underline text-blue-600 hover:text-blue-700 font-bold ml-1">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1.5 font-semibold text-emerald-600">
                            {{ __('Link verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center space-x-4 pt-4 border-t border-slate-100">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-xl text-xs transition duration-150 shadow-md shadow-blue-500/10">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
                   class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100/50">
                    ✨ {{ __('Berhasil Disimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>