@if (Auth::user()->isAdmin())
    <x-admin-layout>
        <div class="mb-8">
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Profil Admin</h1>
            <p class="text-slate-400 text-sm mt-1">Kelola data diri administrator dan pengaturan keamanan akun Anda.</p>
        </div>

        <div class="space-y-8 max-w-4xl">
            <div class="p-6 md:p-8 bg-slate-900 border border-slate-800 rounded-3xl shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 md:p-8 bg-slate-900 border border-slate-800 rounded-3xl shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 md:p-8 bg-slate-900 border border-slate-800 rounded-3xl shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </x-admin-layout>
@else
    <x-user-layout>
        <div class="mb-8">
            <h1 class="text-3xl font-black bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent">Profil Saya</h1>
            <p class="text-slate-400 text-sm mt-1">Perbarui detail profil dan kelola sandi akun Anda.</p>
        </div>

        <div class="space-y-8 max-w-4xl">
            <div class="p-6 md:p-8 bg-slate-900 border border-slate-800 rounded-3xl shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-6 md:p-8 bg-slate-900 border border-slate-800 rounded-3xl shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-6 md:p-8 bg-slate-900 border border-slate-800 rounded-3xl shadow-xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </x-user-layout>
@endif
