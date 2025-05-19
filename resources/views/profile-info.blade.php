<x-app-layout>
        <x-nav-app>

    </x-nav-app>
    @if (session('success'))
    <div class="mb-6 px-4 py-3 text-green-800 bg-green-100 border border-green-300 rounded">
        {{ session('success') }}
    </div>
    @endif

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white border border-gray-200 rounded shadow space-y-10">

        {{-- Actualizar info de usuario --}}
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            <h1 class="text-2xl font-bold mb-4">Actualizar información de usuario</h1>

            @csrf
            @method("PUT")

            <div>
                <label class="block font-medium mb-1">Nombre:</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
            </div>

            <div>
                <label class="block font-medium mb-1">Correo:</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Actualizar info de usuario
            </button>
        </form>

        {{-- Cambiar contraseña --}}
        <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
            <h1 class="text-2xl font-bold mb-4">Cambiar contraseña</h1>

            @csrf
            @method("PUT")

            <div>
                <label class="block font-medium mb-1">Contraseña actual:</label>
                <input type="password" name="current_password"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
            </div>

            <div>
                <label class="block font-medium mb-1">Nueva contraseña:</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
            </div>

            <div>
                <label class="block font-medium mb-1">Confirmar nueva contraseña:</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Cambiar contraseña
            </button>
        </form>
    </div>
    </x-app-layout>
