<x-app-layout>
    <x-nav-app>
        <h2>Aqui ira la barra de navegacion</h2>
    </x-nav-app>

    <h1>Hola

        @if ($user_rol=='doctor')
            Dr.
        @endif

        {{$user_name}}
    </h1>
    <br>


    @if (empty($appointments))
        <h2 style="color: red">No tienes citas agendadas</h2>


            @can('crear cita')
            <x-btn>
                <a href="{{route('appointments.create')}}">
                Agendar nueva cita
            </a>
            </x-btn>
            @endcan

    @else

        @if ($user_rol=='patient')
       <h2>Estas son las citas que tienes agendadas:</h2>
        <x-btn>
        <a href="{{route('appointments.create')}}">
            Agendar nueva cita
        </a>
        </x-btn>
        @else
        <h2>Estas son las citas que atenderas</h2>
        @endif

     @foreach ($appointments as $appointment)
    <x-card>
        <h2 style="color: green">Fecha: {{$appointment['date']}}</h2>
        <h3>Hora de cita: {{$appointment['hour']}}</h3>
        <p>Clinica: Hospital {{$appointment['office']}}</p>
        <a href="{{route("appointments.show", $appointment)}}">Ver detalle cita</a>
    </x-card>
        <br><br>

    @endforeach

    @endif


</x-app-layout>
