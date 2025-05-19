<x-app-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white border border-gray-200 rounded shadow text-center">
        <h1 class="text-xl font-bold mb-6">¿Desea registrarse como?</h1>

        <a href="{{ route('registro-paciente') }}"
           class="inline-block mb-4 w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
            Usuario
        </a><br>
        <a href="{{ route('registro-doctor') }}"
           class="inline-block w-full py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
            Doctor
        </a>
    </div>
    </x-app-layout>
