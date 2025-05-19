<x-app-layout>
        <x-nav-app>

    </x-nav-app>

    <div class="max-w-3xl mx-auto mt-10 px-4 space-y-6">

        <h2 class="text-3xl font-bold text-gray-800">Editar cita médica</h2>

        <form method="POST" action="{{ route('appointments.update', $appointment->id) }}" class="bg-white shadow p-6 rounded-xl space-y-4 border border-gray-200">
            @csrf
            @method('PUT')

            <div>
                <label for="datepicker" class="block text-sm font-medium text-gray-700">Nueva fecha y hora:</label>
                <input type="text" id="datepicker" name="appointment_datetime"
                       value="{{ \Carbon\Carbon::parse($appointment->date)->format('Y-m-d H:i') }}"
                       class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
                       required>
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl">
                Actualizar cita
            </button>
        </form>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        let days = @json($days);
        let dayTimeMap = @json($dayTimeMap);
        let dayMaxTimeMap = @json($dayMaxTimeMap);

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
</x-app-layout>
