<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-900 px-4">
        <div class="w-full max-w-md bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800 dark:text-white">Iniciar Sesión</h1>

            <form method="POST" action="{{ route('login.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Correo
                    </label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('email')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Contraseña
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        value="{{ old('password') }}"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                    @error('password')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                <div>
                    <button
                        type="submit"
                        class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow transition duration-200"
                    >
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
