<x-app-layout>
    <x-nav-app>

    </x-nav-app>

    <div class="max-w-4xl mx-auto mt-10 space-y-6 px-4">

        <h1 class="text-3xl font-bold text-gray-800">
            Hola
            @if ($user_rol == 'doctor')
                Dr.
            @endif
            {{ $user_name }}
        </h1>

        @if (empty($appointments))
            <h2 class="text-xl text-red-600 font-semibold">No tienes citas agendadas</h2>

            @can('crear cita')
                <x-btn>
                    <a href="{{ route('appointments.create') }}">Agendar nueva cita</a>
                </x-btn>
            @endcan

        @else
            @if ($user_rol == 'patient')
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-700">Estas son las citas que tienes agendadas:</h2>
                    <x-btn>
                        <a href="{{ route('appointments.create') }}">Agendar nueva cita</a>
                    </x-btn>
                </div>
            @else
                <h2 class="text-2xl font-semibold text-gray-700">Estas son las citas que atenderás:</h2>
            @endif

            <div class="grid gap-6 mt-6">
                @foreach ($appointments as $appointment)
                    <x-card>
                        <h2 class="text-lg font-semibold text-green-600">Fecha: {{ $appointment['date'] }}</h2>
                        <h3 class="text-md font-medium">Hora de cita: {{ $appointment['hour'] }}</h3>
                        <p class="text-sm text-gray-600">Clínica: Hospital {{ $appointment['office'] }}</p>
                        <a href="{{ route('appointments.show', $appointment) }}"
                           class="text-blue-600 hover:underline mt-2 inline-block">Ver detalle de la cita</a>
                    </x-card>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>
