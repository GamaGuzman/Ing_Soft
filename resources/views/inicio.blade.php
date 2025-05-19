<x-app-layout>
    <header class="w-full max-w-5xl mx-auto px-4 py-4 mb-10 bg-white/80 dark:bg-[#1b1b18]/50 backdrop-blur-md rounded-lg shadow">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a
                        href="{{ route('dashboard') }}"
                        class="px-5 py-2 font-medium text-gray-800 dark:text-gray-200 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-md text-sm transition"
                    >
                        Inicio
                    </a>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="px-5 py-2 font-medium text-gray-800 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md text-sm transition"
                    >
                        Iniciar sesión
                    </a>

                    @if (Route::has('registro'))
                        <a
                            href="{{ route('registro') }}"
                            class="px-5 py-2 font-medium text-white bg-gray-800 hover:bg-gray-700 dark:bg-white dark:text-gray-900 dark:hover:bg-gray-200 rounded-md text-sm transition"
                        >
                            Registro
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>

      <main class="max-w-4xl mx-auto px-4 py-8 bg-white rounded-lg shadow-sm space-y-8">
        {{-- Imagen centrada con fondo claro --}}
        <div class="bg-gray-100 p-6 rounded-md flex justify-center">
            <img src="{{ asset('image.png') }}" alt="Programa" class="max-w-xs sm:max-w-md md:max-w-lg">
        </div>

        {{-- Título principal --}}
        <h1 class="text-2xl sm:text-3xl font-semibold text-gray-900">
            ¿Quienes somos?
        </h1>

        {{-- Párrafo descriptivo con estilos similares --}}
        <div class="text-gray-700 leading-relaxed text-justify space-y-4 text-base sm:text-lg">

            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat modi accusantium temporibus incidunt reprehenderit rem debitis, corrupti natus harum doloremque nisi, ut repudiandae facere laudantium sint aliquid omnis laboriosam sequi.
            </p>
            <br>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem deserunt, velit minus aut labore saepe molestiae ducimus dolores? Natus reiciendis accusantium officiis unde aut labore nam optio nesciunt architecto deserunt.
            </p>
        </div>
    </main>
</x-app-layout>
