<x-app-layout>

    @if (session('success'))
    <div class="mb-4 px-4 py-2 bg-green-100 border border-green-300 text-green-800 rounded">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="mb-4 px-4 py-2 bg-red-100 border border-red-300 text-red-800 rounded">
        {{ session('error') }}
    </div>
    @endif



    <div class="max-w-md mx-auto mt-10 p-6 bg-white border border-gray-200 rounded shadow">
        <h1 class="text-xl font-bold mb-6 text-center">Iniciar Sesión</h1>

        <form method="POST" action="{{ route('login.store') }}">
            @csrf

            <label class="block mb-4">
                <span class="block mb-1 font-medium">Correo:</span>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('email')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </label>

            <label class="block mb-6">
                <span class="block mb-1 font-medium">Contraseña:</span>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('password')
                    <small class="text-red-500">{{ $message }}</small>
                @enderror
            </label>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition duration-200">
                Entrar
            </button>
        </form>
    </div>
    </x-app-layout>
