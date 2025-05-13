<x-app-layout>

    <form action="{{route("profile.update")}}" method="POST">

        <h1>Alterar info de usuario</h1>
        @csrf
        @method("PUT")

        <label>
            Nombre:
            <input type="text" name="name" value="{{auth()->user()->name}}">
        </label>

        <br><br>

        <label>
            Correo:
            <input type="email" name="email" value="{{auth()->user()->email}}">
        </label>

        <br><br>

        <button type="submit">Actualizar info de usuario</button>
    </form>

    <form action="{{route("profile.password")}}" method="POST">
        <h1>Cambiar contraseña</h1>Cambiar contraseña:

        @csrf
        @method("PUT")

        <label>Introduce tu contraseña actual</label>

        <input type="password" name="current_password">
        <br><br>

        <label>
            Password:
            <input type="password" name="password">
        </label>

        <br><br>

        <label>
            Confirmar password:
            <input type="password" name="password_confirmation">
        </label>


    </form>
</x-app-layout>
