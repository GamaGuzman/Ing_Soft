<x-app-layout>

    <h1>Registro de doctores</h1>

    <form method="POST" action="{{ route('registro-doctor-store') }}">

        @csrf

        <label>
            Nombre:

            <input type="text" name="name" value="{{ old('name') }}">

            @error('name')
                <small>{{ $message }}</small>

            @enderror

        </label>

        <br><br>

        <label>
            Correo:

            <input type="text" name="email" value="{{ old('email') }}">

            @error('email')
                <small>{{ $message }}</small>
            @enderror

        </label>
        <br><br>

        <label>

            Contraseña:
            <input type="password" name="password" value="{{ old('password') }}">

            @error('password')
                <small>{{ $message }}</small>
            @enderror

        </label>
        <br><br>

        <label>

            Confirmar contraseña:

            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">

            @error('password_confirmation')
                <small>{{ $message }}</small>
            @enderror
        </label>

        <br><br>

        <label>
            Campo:

            <select name="field">
                <option value="medicina general">Medicina General</option>
                <option value="pediatria">Pediatria</option>
                <option value="ginecologia">Ginecologia</option>
                <option value="traumatologia">Traumatologia</option>
                <option value="cardiologia">Cardiologia</option>
            </select>

        </label>
        <br><br>

        <label>

            Especialidad:

            <select name="speciality">
                <option value="cirugía general">Especialista en cirugía general</option>
                <option value="Medicina Interna">Especialista en Medicina Interna</option>
                <option value="Ginecología y Obstetricia">Especialista en Ginecología y Obstetricia</option>
                <option value="Pediatría">Especialista en pediatria</option>
            </select>

        </label>
        <br><br>

        <label>

            Edad:
            <input type="number" name="age" value="{{ old('age') }}">

            @error('age')
                <small>{{ $message }}</small>
            @enderror
        </label>
        <br><br>


        <label>

            RFC:
            <input type="text" name="rfc" value="{{ old('rfc') }}">

            @error('rfc')
                <small>{{ $message }}</small>
            @enderror
        </label>
        <br><br>

        <label>
            Oficina:

            <select name="office">
                <option value="14 Sur">Hospital de la 14 Sur</option>
                <option value="Hidalgo">Hospital de la Calle Hidalgo</option>
                <option value="Valsequillo">Hospital de Valsequillo</option>
            </select>

        </label>
        <br><br>


        <label>

            Telefono:
            <input type="number" name="phone" value="{{ old('phone') }}">

            @error('phone')
                <small>{{ $message }}</small>
            @enderror
        </label>
        <br><br>

        <label>
            Ingresa los dias que te gustaria trabajar:

            <input type="checkbox" name="days[]" value="monday">Lunes <br>
            <input type="checkbox" name="days[]" value="tuesday">Martes<br>
            <input type="checkbox" name="days[]" value="wednesday">Miercoles<br>
            <input type="checkbox" name="days[]" value="thursday">Jueves<br>
            <input type="checkbox" name="days[]" value="friday">Viernes<br>
            <input type="checkbox" name="days[]" value="saturday">Sabado<br>
            <input type="checkbox" name="days[]" value="sunday">Domingo<br>
        </label>
        <br><br>

        <label >
            Horario:
            <select name="schedule">
                <option value="07:00:00,14:00:00">Turno matutino (De 7:00 a 14:00)</option>
                <option value="11:00:00,18:00:00">Turno vespertino (De 11:00 a 18:00)</option>
            </select>
        </label>
        <br><br>

        <button type="submit"> Entrar</button>
    </form>

</x-app-layout>
