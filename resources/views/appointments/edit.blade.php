<x-app-layout>
    <h2>Editar cita médica</h2>

    <form method="POST" action="{{ route('appointments.update', $appointment->id) }}">
        @csrf
        @method('PUT')

        <label for="datepicker">Nueva fecha y hora:</label>
        <input type="text" id="datepicker" name="appointment_datetime"
               value="{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d H:i') }}" required>

        <button type="submit">Actualizar cita</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        let days = @json($days);
        let dayTimeMap = @json($dayTimeMap);
        let dayMaxTimeMap = @json($dayMaxTimeMap);

        console.log("Días disponibles:", days);
        console.log("Horas mínimas:", dayTimeMap);
        console.log("Horas máximas:", dayMaxTimeMap);

        flatpickr("#datepicker", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            enable: [
                function(date) {
                    return days.includes(date.getDay());
                }
            ],
            onReady: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    let selected = selectedDates[0].getDay();
                    instance.set("minTime", dayTimeMap[selected] || "00:00");
                    instance.set("maxTime", dayMaxTimeMap[selected] || "23:59");
                }
            },
            onChange: function(selectedDates, dateStr, instance) {
                if (!selectedDates.length) return;
                let selected = selectedDates[0].getDay();
                instance.set("minTime", dayTimeMap[selected] || "00:00");
                instance.set("maxTime", dayMaxTimeMap[selected] || "23:59");
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
    @endif

</x-app-layout>
