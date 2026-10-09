<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMPEL BBLKL</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="min-h-screen bg-slate-900 flex items-center justify-center px-4">

    <div class="w-full max-w-sm">

        {{-- LOGO --}}
        <div class="mb-8 flex flex-col items-center gap-3 text-center">

            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 shadow-lg">
                <span class="text-2xl font-bold text-white">S</span>
            </div>

            <div>
                <h1 class="text-xl font-bold text-white">
                    SIMPEL BBLKL
                </h1>
                <p class="text-sm text-slate-400">
                    Sistem Informasi Pengolahan Data Laboratorium
                </p>
            </div>

        </div>

        {{-- CARD LOGIN --}}
        <div class="rounded-2xl border border-slate-700 bg-slate-800 p-8 shadow-2xl">

            <h2 class="mb-6 text-lg font-bold text-white">
                Masuk ke Akun Anda
            </h2>

            {{-- ERROR --}}
            @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-400">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- USERNAME --}}
                <div>
                    <label
                        for="username"
                        class="mb-2 block text-sm font-semibold text-slate-300"
                    >
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        autofocus
                        placeholder="Masukkan username"
                        class="w-full rounded-xl border border-slate-600 bg-slate-700 px-4 py-3 text-sm text-white placeholder-slate-500
                               focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30
                               @error('username') border-red-500 @enderror"
                        required
                    >
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label
                        for="password"
                        class="mb-2 block text-sm font-semibold text-slate-300"
                    >
                        Password
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                            class="w-full rounded-xl border border-slate-600 bg-slate-700 px-4 py-3 text-sm text-white placeholder-slate-500
                                   focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/30
                                   @error('password') border-red-500 @enderror"
                            required
                        >

                        {{-- TOGGLE SHOW/HIDE PASSWORD --}}
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-200"
                            tabindex="-1"
                            aria-label="Tampilkan atau sembunyikan password"
                        >
                            <svg id="iconShow" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="iconHide" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- REMEMBER ME --}}
                <div class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        id="remember"
                        name="remember"
                        class="h-4 w-4 rounded border-slate-600 bg-slate-700 text-blue-600 focus:ring-blue-500/30"
                    >
                    <label for="remember" class="text-sm text-slate-400">
                        Ingat saya
                    </label>
                </div>

                {{-- SUBMIT --}}
                <button
                    type="submit"
                    class="w-full rounded-xl bg-blue-600 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/40"
                >
                    Masuk
                </button>

            </form>

        </div>

        <p class="mt-6 text-center text-xs text-slate-600">
            &copy; {{ date('Y') }} BBLKL. All rights reserved.
        </p>

    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const iconShow = document.getElementById('iconShow');
            const iconHide = document.getElementById('iconHide');

            if (input.type === 'password') {
                input.type = 'text';
                iconShow.classList.add('hidden');
                iconHide.classList.remove('hidden');
            } else {
                input.type = 'password';
                iconShow.classList.remove('hidden');
                iconHide.classList.add('hidden');
            }
        }
    </script>

</body>

</html>
