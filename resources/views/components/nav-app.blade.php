<nav class="bg-gray-100 px-4 py-3 flex justify-between items-center shadow rounded mb-6">
    <div class="text-lg font-semibold text-gray-700">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
            <img src="{{ asset('hospital-svgrepo-com.svg') }}" alt="Icono hospital" class="h-8 w-8">
            <h2 class="text-xl font-bold">Hospital</h2>
        </a>
    </div>

    <div class="flex space-x-3">
        <a href="{{ route('profile.edit') }}">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Editar perfil
            </button>
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                Cerrar sesión
            </button>
        </form>


    </div>
</nav>
