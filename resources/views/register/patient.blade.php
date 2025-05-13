<x-app-layout>

    <h1>Registro de usuarios</h1>

    <form method="POST" href="{{ route('patient.store') }}">

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

            Edad:

            <input type="number" name="age" value="{{ old('age') }}">

            @error('age')
                <small>{{ $message }}</small>
            @enderror

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

            <input type="checkbox" name="terms" value="1">

            Acepto los terminos y condiciones

            @error('terms')
                <small>{{ $message }}</small>
            @enderror

        </label>

        <br><br>

        <button type="submit"> Entrar</button>

    </form>

    </x-app-layout>
