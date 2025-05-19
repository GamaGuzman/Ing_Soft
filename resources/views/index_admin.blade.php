<x-app-layout>
    <x-nav-app></x-nav-app>

    <div class="max-w-4xl mx-auto mt-10 space-y-6 px-4">

        <h1 class="text-3xl font-bold text-gray-800">
            Hola Administrador
        </h1>

        <h2 class="text-2xl text-gray-700 font-semibold">Gestión de Doctores</h2>

        @if(session('success'))
            <div class="bg-green-100 p-2 rounded my-2 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <x-card>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border text-sm">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-2 py-1 text-left">Nombre</th>
                            <th class="px-2 py-1 text-left">Email</th>
                            <th class="px-2 py-1 text-left">Especialidad</th>
                            <th class="px-2 py-1 text-left">Dirección</th>
                            <th class="px-2 py-1 text-left">Estado</th>
                            <th class="px-2 py-1 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctors as $doctor)
                            <tr class="border-t">
                                <td class="px-2 py-1">{{ $doctor->user->name }}</td>
                                <td class="px-2 py-1">{{ $doctor->user->email }}</td>
                                <td class="px-2 py-1">{{ $doctor->speciality }}</td>
                                <td class="px-2 py-1">{{ $doctor->office_address }}</td>
                                <td class="px-2 py-1">
                                    @if($doctor->is_active)
                                        <span class="text-green-600 font-medium">Activo</span>
                                    @else
                                        <span class="text-red-600 font-medium">Inactivo</span>
                                    @endif
                                </td>
                                <td class="px-2 py-1">
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('admin.doctors.toggle', $doctor->id) }}">
                                            @csrf
                                            <button class="bg-blue-500 text-white px-2 py-1 rounded text-xs">
                                                {{ $doctor->is_active ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.doctors.destroy', $doctor->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('¿Eliminar doctor?')" class="bg-red-500 text-white px-2 py-1 rounded text-xs">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>

    </div>
</x-app-layout>
