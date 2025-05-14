<x-app-layout>
    <header class="w-full lg:max-w-4xl max-w-[335px] mx-auto px-4 py-4 mb-6 bg-white/50 dark:bg-[#1b1b18]/50 backdrop-blur-sm rounded-lg shadow-sm not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-3">
                @auth
                    <a
                        href="{{ route('dashboard') }}"
                        class="px-5 py-2 font-medium text-[#1b1b18] dark:text-[#EDEDEC] bg-[#f3f3f2] dark:bg-[#30302c] border border-transparent hover:bg-[#e8e8e6] dark:hover:bg-[#40403b] rounded-md text-sm transition-all duration-200 ease-in-out"
                    >
                        Inicio
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="px-5 py-2 font-medium text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f3f3f2] dark:hover:bg-[#30302c] rounded-md text-sm transition-all duration-200 ease-in-out"
                    >
                        Iniciar sesión
                    </a>

                    @if (Route::has('registro'))
                        <a
                            href="{{ route('registro') }}"
                            class="px-5 py-2 font-medium text-white bg-[#1b1b18] hover:bg-[#33332e] dark:bg-[#EDEDEC] dark:text-[#1b1b18] dark:hover:bg-[#d6d6d3] rounded-md text-sm transition-all duration-200 ease-in-out"
                        >
                            Registro
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    </x-app-layout>
