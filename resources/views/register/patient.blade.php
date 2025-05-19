<x-app-layout>
        <div class="max-w-md mx-auto mt-10 p-6 bg-white border border-gray-200 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Registro de usuarios</h1>

        <form method="POST" action="{{ route('patient.store') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Nombre:</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
                @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Correo -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Correo:</label>
                <input type="text" name="email" value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
                @error('email') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Contraseña:</label>
                <input type="password" name="password" value="{{ old('password') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
                @error('password') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Confirmar contraseña:</label>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
                @error('password_confirmation') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Edad -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Edad:</label>
                <input type="number" name="age" value="{{ old('age') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
                @error('age') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Teléfono -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Teléfono:</label>
                <input type="number" name="phone" value="{{ old('phone') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
                @error('phone') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Términos y condiciones -->
            <div class="mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="terms" value="1" class="mr-2">
                    Acepto los términos y condiciones
                </label>
                <br>
                @error('terms') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Botón -->
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Entrar
            </button>
        </form>
    </div>
    </x-app-layout>
