<x-app-layout>

    <a href="{{route("dashboard")}}">Volver a pagina de inicio</a>
    <br>

    <h1>Detalle de la cita:</h1>
    <p>Fecha agendada: {{$appointment['date']}}</p>
    <p>Hora de la cita: {{$appointment['hour']}}</p>
    <p>Doctor que le atendera: {{$appointment['doctor']}}</p>
    <p>Clinica en la que se le atendera: {{$appointment['office']}}</p>

    <a href="{{ route('appointments.edit', $appointment['id']) }}">Editar cita</a>


    @can("eliminar cita")
    <form action="{{route("appointments.destroy", $appointmentRaw)}}" method="POST">
        @csrf

        @method("DELETE")


        <button type="submit">borrar cita</button>
    </form>
    @endcan

</x-app-layout>
