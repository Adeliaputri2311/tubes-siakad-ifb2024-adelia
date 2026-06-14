<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col">
            <h2 class="font-bold text-2xl text-slate-800 tracking-tight">
                {{ __('Pengaturan Akun') }}
            </h2>
            <p class="text-xs text-slate-400 font-medium mt-0.5">Kelola informasi profil, autentikasi email, dan keamanan kata sandi Anda.</p>
        </div>
    </x-slot>

    <div class="max-w-3xl space-y-6">
        
        @if (session('status') === 'profile-updated')
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-3.5 rounded-2xl shadow-sm text-sm flex items-center space-x-3">
                <span class="text-base">✨</span>
                <span class="font-semibold">Profil Anda berhasil diperbarui! Perubahan data identitas telah disimpan ke database.</span>
            </div>
        @endif

        @if (session('status') === 'password-updated')
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-5 py-3.5 rounded-2xl shadow-sm text-sm flex items-center space-x-3">
                <span class="text-base">🔒</span>
                <span class="font-semibold">Kata sandi Anda berhasil diubah! Gunakan sandi baru Anda pada sesi login berikutnya.</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 transition hover:shadow-md duration-200">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8 transition hover:shadow-md duration-200">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

    </div>
</x-app-layout>