<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-900 px-4">
        <div class="w-full max-w-md bg-gray-100 dark:bg-gray-800 p-8 rounded-lg shadow-lg text-center">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
                ¿Desea registrarse como?
            </h1>

            <div class="space-y-4">
                <a href="{{ route('registro-paciente') }}"
                   class="block w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow transition duration-200">
                    Usuario
                </a>

                <a href="{{ route('registro-doctor') }}"
                   class="block w-full py-3 px-6 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow transition duration-200">
                    Doctor
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
