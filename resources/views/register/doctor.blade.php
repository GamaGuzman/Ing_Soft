<x-app-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white border border-gray-200 rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">Registro de Doctores</h1>

        <form method="POST" action="{{ route('registro-doctor-store') }}">
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
                @error('email') <s  mall class="text-red-500">{{ $message }}</s> @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Contraseña:</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
                @error('password') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Confirmar contraseña -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Confirmar contraseña:</label>
                <input type="password" name="password_confirmation"
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

            <!-- RFC -->
            <div class="mb-4">
                <label class="block font-medium mb-1">RFC:</label>
                <input type="text" name="rfc" value="{{ old('rfc') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded">
                @error('rfc') <small class="text-red-500">{{ $message }}</small> @enderror
            </div>

            <!-- Campo -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Campo:</label>
                <select name="field" class="w-full px-4 py-2 border border-gray-300 rounded">
                    <option value="medicina general">Medicina General</option>
                    <option value="pediatria">Pediatría</option>
                    <option value="ginecologia">Ginecología</option>
                    <option value="traumatologia">Traumatología</option>
                    <option value="cardiologia">Cardiología</option>
                </select>
            </div>

            <!-- Especialidad -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Especialidad:</label>
                <select name="speciality" class="w-full px-4 py-2 border border-gray-300 rounded">
                    <option value="cirugía general">Cirugía General</option>
                    <option value="Medicina Interna">Medicina Interna</option>
                    <option value="Ginecología y Obstetricia">Ginecología y Obstetricia</option>
                    <option value="Pediatría">Pediatría</option>
                </select>
            </div>

            <!-- Oficina -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Oficina:</label>
                <select name="office" class="w-full px-4 py-2 border border-gray-300 rounded">
                    <option value="14 Sur">Hospital de la 14 Sur</option>
                    <option value="Hidalgo">Hospital de la Calle Hidalgo</option>
                    <option value="Valsequillo">Hospital de Valsequillo</option>
                </select>
            </div>

            <!-- Días laborales -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Días disponibles:</label>
                @php
                    $days = ['monday'=>'Lunes','tuesday'=>'Martes','wednesday'=>'Miércoles','thursday'=>'Jueves','friday'=>'Viernes','saturday'=>'Sábado','sunday'=>'Domingo'];
                @endphp
                @foreach ($days as $value => $label)
                    <label class="block">
                        <input type="checkbox" name="days[]" value="{{ $value }}"> {{ $label }}
                    </label>
                @endforeach
                @error('days') <small class="text-red-500">{{ $message }}</small> @enderror

            </div>

            <!-- Horario -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Horario:</label>
                <select name="schedule" class="w-full px-4 py-2 border border-gray-300 rounded">
                    <option value="07:00:00,14:00:00">Turno matutino (7:00 - 14:00)</option>
                    <option value="11:00:00,18:00:00">Turno vespertino (11:00 - 18:00)</option>
                </select>
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
                Registrarse
            </button>
        </form>
    </div>
</x-app-layout>
