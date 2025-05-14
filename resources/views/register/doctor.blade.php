<x-app-layout>
    <div class="min-h-screen flex items-center justify-center bg-white dark:bg-gray-900 px-4">
        <div class="w-full max-w-2xl bg-gray-100 dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">
                Registro de doctores
            </h1>

            <form method="POST" action="{{ route('registro-doctor-store') }}" class="space-y-5">
                @csrf

                {{-- Nombre --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nombre
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full input">
                    @error('name')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Correo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Correo
                    </label>
                    <input type="text" name="email" value="{{ old('email') }}"
                           class="w-full input">
                    @error('email')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Contraseña
                    </label>
                    <input type="password" name="password" value="{{ old('password') }}"
                           class="w-full input">
                    @error('password')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Confirmar contraseña --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Confirmar contraseña
                    </label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                           class="w-full input">
                    @error('password_confirmation')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Campo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Campo
                    </label>
                    <select name="field" class="w-full input">
                        <option value="medicina general">Medicina General</option>
                        <option value="pediatria">Pediatría</option>
                        <option value="ginecologia">Ginecología</option>
                        <option value="traumatologia">Traumatología</option>
                        <option value="cardiologia">Cardiología</option>
                    </select>
                </div>

                {{-- Especialidad --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Especialidad
                    </label>
                    <select name="speciality" class="w-full input">
                        <option value="cirugía general">Cirugía General</option>
                        <option value="Medicina Interna">Medicina Interna</option>
                        <option value="Ginecología y Obstetricia">Ginecología y Obstetricia</option>
                        <option value="Pediatría">Pediatría</option>
                    </select>
                </div>

                {{-- Edad --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Edad
                    </label>
                    <input type="number" name="age" value="{{ old('age') }}"
                           class="w-full input">
                    @error('age')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                {{-- RFC --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        RFC
                    </label>
                    <input type="text" name="rfc" value="{{ old('rfc') }}"
                           class="w-full input">
                    @error('rfc')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Oficina --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Oficina
                    </label>
                    <select name="office" class="w-full input">
                        <option value="14 Sur">Hospital de la 14 Sur</option>
                        <option value="Hidalgo">Hospital de la Calle Hidalgo</option>
                        <option value="Valsequillo">Hospital de Valsequillo</option>
                    </select>
                </div>

                {{-- Teléfono --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Teléfono
                    </label>
                    <input type="number" name="phone" value="{{ old('phone') }}"
                           class="w-full input">
                    @error('phone')
                        <small class="text-red-600 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Días de trabajo --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Días que desea trabajar
                    </label>
                    <div class="grid grid-cols-2 gap-2 text-gray-700 dark:text-gray-300">
                        @foreach (['monday' => 'Lunes', 'tuesday' => 'Martes', 'wednesday' => 'Miércoles', 'thursday' => 'Jueves', 'friday' => 'Viernes', 'saturday' => 'Sábado', 'sunday' => 'Domingo'] as $key => $day)
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="days[]" value="{{ $key }}" class="text-blue-600">
                                {{ $day }}
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Horario --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Horario
                    </label>
                    <select name="schedule" class="w-full input">
                        <option value="07:00:00,14:00:00">Turno matutino (07:00 - 14:00)</option>
                        <option value="11:00:00,18:00:00">Turno vespertino (11:00 - 18:00)</option>
                    </select>
                </div>

                {{-- Botón --}}
                <div class="pt-4">
                    <button type="submit"
                            class="w-full py-3 px-6 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow transition duration-200">
                        Registrar doctor
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tailwind helper styles --}}
    <style>
        .input {
            @apply px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500;
        }
    </style>
</x-app-layout>
