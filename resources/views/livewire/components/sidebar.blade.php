
    <div class="space-y-4">
        <a href="{{ route('dashboard') }}" class="block p-2 rounded-md hover:bg-gray-700 transition duration-300">
            <i class="fa-solid fa-list-check mr-2"></i> Daftar Tugas
        </a>
        {{-- <a href="{{ route('tasks.create') }}" class="block p-2 rounded-md hover:bg-gray-700 transition duration-300">
            <i class="fa-solid fa-square-plus mr-2"></i> Tambah Tugas
        </a> --}}
        <a href="{{ route('categories') }}" class="block p-2 rounded-md hover:bg-gray-700 transition duration-300">
            <i class="fa-solid fa-tags mr-2"></i> Kelola Kategori
        </a>

        <div class="h-px bg-gray-700 my-4"></div>

        {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left block p-2 rounded-md text-red-400 hover:bg-gray-700 transition duration-300">
                <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
            </button>
        </form> --}}
    </div>

