<x-app-layout>
    @can('crear cita')
    <h2>Crear cita médica</h2>

    @if (session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    {{-- Paso 1: Especialidad --}}
    <form method="GET" action="{{ route('appointments.create') }}">
        <label for="speciality">Especialidad:</label>
        <select name="speciality" id="speciality" onchange="this.form.submit()">
            <option value="">-- Selecciona --</option>
            @foreach ($specialities as $esp)
                <option value="{{ $esp }}" {{ $selectedSpeciality == $esp ? 'selected' : '' }}>{{ $esp }}</option>
            @endforeach
        </select>
    </form>

    {{-- Paso 2: Clínica --}}
    @if ($selectedSpeciality && !empty($doctors_offices))
    <form method="GET" action="{{ route('appointments.create') }}">
        <input type="hidden" name="speciality" value="{{ $selectedSpeciality }}">
        <label for="office_address">Clínica:</label>
        <select name="office_address" id="office_address" onchange="this.form.submit()">
            @foreach ($doctors_offices as $office)
                <option value="{{ $office }}" {{ $selectedOffice == $office ? 'selected' : '' }}>{{ $office }}</option>
            @endforeach
        </select>
    </form>
    @endif

    {{-- Paso 3: Doctor --}}
    @if ($selectedOffice && !empty($doctors))
    <form method="GET" action="{{ route('appointments.create') }}">
        <input type="hidden" name="speciality" value="{{ $selectedSpeciality }}">
        <input type="hidden" name="office_address" value="{{ $selectedOffice }}">
        <label for="doctor">Doctor:</label>
        <select name="doctor" id="doctor" onchange="this.form.submit()">
            @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ $selectedDoctor == $doctor->id ? 'selected' : '' }}>
                    {{ $doctor->name }}
                </option>
            @endforeach
        </select>
    </form>
    @endif

    {{-- Paso 4: Calendario con días y horas disponibles --}}
    @if (!empty($days) && !empty($dayTimeMap))
    <form method="POST" action="{{ route('appointments.store') }}" onsubmit="console.log('Enviando:', document.getElementById('datepicker').value)">

        @csrf
        <label for="datepicker">Fecha y hora:</label>
        <input type="text" id="datepicker" name="appointment_datetime" required placeholder="Selecciona una fecha">

        <input type="hidden" name="doctor_id" value="{{ $selectedDoctor }}">
        <button type="submit">Reservar cita</button>

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
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    </form>
    @endif
    @endif

    <br><br>
    <a href="{{route('dashboard')}}">Volver al inicio</a>
    @endcan
</x-app-layout>
