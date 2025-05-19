<x-app-layout>
        <x-nav-app>

    </x-nav-app>

    <div class="max-w-3xl mx-auto mt-10 px-4 space-y-6">

        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">
            ← Volver a página de inicio
        </a>

        <h1 class="text-3xl font-bold text-gray-800">Detalle de la cita</h1>

        <div class="bg-white shadow rounded-xl p-6 space-y-2 border border-gray-200">
            <p class="text-lg"><span class="font-semibold text-gray-700">Fecha agendada:</span> {{ $appointment['date'] }}</p>
            <p class="text-lg"><span class="font-semibold text-gray-700">Hora de la cita:</span> {{ $appointment['hour'] }}</p>
            @can("eliminar cita")
                <p class="text-lg"><span class="font-semibold text-gray-700">Doctor que le atenderá:</span> {{ $appointment['doctor'] }}</p>
            @endcan

            <p class="text-lg"><span class="font-semibold text-gray-700">Paciente que agendo la cita:</span> {{ $appointment['patient'] }}</p>
            <p class="text-lg"><span class="font-semibold text-gray-700">Clínica:</span> {{ $appointment['office'] }}</p>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-4 sm:space-y-0">
            <a href="{{ route('appointments.edit', $appointment['id']) }}"
               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-xl">
                Editar cita
            </a>

            @can('eliminar cita')
                <form action="{{ route('appointments.destroy', $appointmentRaw) }}" method="POST"
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-xl">
                        Borrar cita
                    </button>
                </form>
            @endcan
        </div>

    </div>
</x-app-layout>
