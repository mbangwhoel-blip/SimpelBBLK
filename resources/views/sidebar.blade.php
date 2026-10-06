
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<aside class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col bg-slate-900 text-white shadow-xl">

    {{-- LOGO --}}
    <div class="flex h-20 shrink-0 items-center gap-3 border-b border-slate-700 px-6">

        <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-600">
            <span class="text-xl font-bold">S</span>
        </div>

        <div>
            <h1 class="text-lg font-bold">
                SIMPEL
            </h1>

            <p class="text-xs text-slate-400">
                BBLKL
            </p>
        </div>

    </div>


    {{-- MENU --}}
    <nav class="flex-1 px-4 py-8">

        <p class="mb-4 px-4 text-xm font-semibold uppercase tracking-wider text-slate-500">
            Menu Utama
        </p>


        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}"
           class="mb-2 flex items-center gap-4 rounded-2xl px-5 py-4 transition
           {{ request()->routeIs('dashboard') 
                ? 'bg-blue-600 text-white' 
                : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

            <svg class="h-6 w-6"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path d="M3 10.5L12 3l9 7.5"></path>
                <path d="M5 9.5V21h14V9.5"></path>
            </svg>

            <span class="text-base font-semibold">
                Dashboard
            </span>
        </a>


        {{-- INPUT BULANAN --}}
        <a href="{{ route('input') }}"
            class="mb-2 flex items-center gap-4 rounded-2xl px-5 py-4 transition
            {{ request()->routeIs('input') 
                ? 'bg-blue-600 text-white'
                : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

            <svg
                class="h-5 w-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <rect
                    x="5"
                    y="3"
                    width="14"
                    height="18"
                    rx="2"></rect>

                <path d="M9 3V2h6v1"></pathinfo>

            </svg>

            <span class="text-base font-semibold">
                Input Data
            </span>
        </a>

        {{-- DATA --}}
        <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
            Data
        </p>


        {{-- IMPORT --}}
        <a href="#"
           class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white">

            <svg class="h-5 w-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V3"/>

            </svg>

            <span>Import Data</span>

        </a>


        {{-- EXPORT --}}
        <a href="#"
           class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white">

            <svg class="h-5 w-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M17 10l-5-5m0 0L7 10m5-5v12"/>

            </svg>

            <span>Export Data</span>

        </a>


        {{-- MASTER DATA --}}
        <p class="mb-3 mt-8 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">
            Master Data
        </p>


        {{-- WILAYAH --}}
        <a href="#"
           class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white">

            <svg class="h-5 w-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 21s7-5.4 7-11a7 7 0 10-14 0c0 5.6 7 11 7 11z"/>

                <circle cx="12" cy="10" r="2.5"/>

            </svg>

            <span>Wilayah</span>

        </a>


        {{-- UNIT --}}
        <a href="#"
           class="mb-2 flex items-center gap-3 rounded-xl px-4 py-3 text-sm text-slate-300 transition hover:bg-slate-800 hover:text-white">

            <svg class="h-5 w-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M3 21h18M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16M9 7h2m-2 4h2m4-4h2m-2 4h2"/>

            </svg>

            <span>Unit / Instansi</span>

        </a>

    </nav>


    {{-- USER --}}
    <div class="shrink-0 border-t border-slate-700 p-4">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 font-semibold">
                A
            </div>

            <div class="min-w-0 flex-1">

                <p class="truncate text-sm font-semibold">
                    Admin
                </p>

                <p class="truncate text-xs text-slate-400">
                    Administrator
                </p>

            </div>

            <button class="rounded-lg p-2 text-slate-400 hover:bg-slate-800 hover:text-red-400">

                <svg class="h-5 w-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/>

                </svg>

            </button>

        </div>

    </div>

</aside>