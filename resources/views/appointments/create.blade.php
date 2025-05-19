<x-app-layout>
        <x-nav-app>

    </x-nav-app>

    @can('crear cita')
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white border border-gray-200 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Crear cita médica</h2>

        @if (session('success'))
            <p class="text-green-600 font-semibold mb-4 text-center">{{ session('success') }}</p>
        @endif

        {{-- Paso 1: Especialidad --}}
        <form method="GET" action="{{ route('appointments.create') }}" class="mb-4">
            <label for="speciality" class="block font-medium mb-1">Especialidad:</label>
            <select name="speciality" id="speciality" onchange="this.form.submit()"
                class="w-full px-4 py-2 border border-gray-300 rounded">
                <option value="">-- Selecciona --</option>
                @foreach ($specialities as $esp)
                    <option value="{{ $esp }}" {{ $selectedSpeciality == $esp ? 'selected' : '' }}>{{ $esp }}</option>
                @endforeach
            </select>
        </form>

        {{-- Paso 2: Clínica --}}
        @if ($selectedSpeciality && !empty($doctors_offices))
        <form method="GET" action="{{ route('appointments.create') }}" class="mb-4">
            <input type="hidden" name="speciality" value="{{ $selectedSpeciality }}">
            <label for="office_address" class="block font-medium mb-1">Clínica:</label>
            <select name="office_address" id="office_address" onchange="this.form.submit()"
                class="w-full px-4 py-2 border border-gray-300 rounded">
                @foreach ($doctors_offices as $office)
                    <option value="{{ $office }}" {{ $selectedOffice == $office ? 'selected' : '' }}>{{ $office }}</option>
                @endforeach
            </select>
        </form>
        @endif

        {{-- Paso 3: Doctor --}}
        @if ($selectedOffice && !empty($doctors))
        <form method="GET" action="{{ route('appointments.create') }}" class="mb-4">
            <input type="hidden" name="speciality" value="{{ $selectedSpeciality }}">
            <input type="hidden" name="office_address" value="{{ $selectedOffice }}">
            <label for="doctor" class="block font-medium mb-1">Doctor:</label>
            <select name="doctor" id="doctor" onchange="this.form.submit()"
                class="w-full px-4 py-2 border border-gray-300 rounded">
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $selectedDoctor == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </form>
        @endif

        {{-- Paso 4: Calendario --}}
        @if (!empty($days) && !empty($dayTimeMap))
        <form method="POST" action="{{ route('appointments.store') }}"
            class="mb-4" onsubmit="console.log('Enviando:', document.getElementById('datepicker').value)">
            @csrf

            <label for="datepicker" class="block font-medium mb-1">Fecha y hora:</label>
            <input type="text" id="datepicker" name="appointment_datetime" required
                class="w-full px-4 py-2 border border-gray-300 rounded mb-4"
                placeholder="Selecciona una fecha">

            <input type="hidden" name="doctor_id" value="{{ $selectedDoctor }}">

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Reservar cita
            </button>

            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script>
                let days = @json($days);
                let dayTimeMap = @json($dayTimeMap);

                flatpickr("#datepicker", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: "today",
                    enable: [date => days.includes(date.getDay())],
                    onChange: function(selectedDates, dateStr, instance) {
                        if (!selectedDates.length) return;
                        let selected = selectedDates[0].getDay();
                        instance.set("minTime", dayTimeMap[selected] || "00:00");
                    }
                });
            </script>

            @if ($errors->any())
            <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>
        @endif

        <div class="text-center mt-6">
            <a href="{{ route('dashboard') }}"
                class="text-blue-600 hover:underline font-medium">
                Volver al inicio
            </a>
        </div>
    </div>
    @endcan
    </x-app-layout>
