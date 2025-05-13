<x-app-layout>
<div>
    <h1>Iniciar Sesión</h1>

    <form method="POST" href="{{ route('login.store') }}">

        @csrf

        <label>
            Correo:

            <input type="text" name="email" value="{{ old('email') }}">

            @error('email')
            <small>{{ $message }}</small>
            @enderror

        </label>

        <label>

            Contraseña:
            <input type="password" name="password" value="{{ old('password') }}">

            @error('password')
            <small>{{ $message }}</small>
            @enderror

        </label>

        <button type="submit"> Entrar</button>
    </form>


</div>

</x-app-layout>
