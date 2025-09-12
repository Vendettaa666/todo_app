<nav class="bg-gray-800 text-white p-4 shadow-md rounded-md">
    <div class="container mx-auto flex justify-between items-center">
        <a href="#" wire:navigate class="flex items-center gap-3">
            <x-application-logo class="w-10 h-10" />
            <span
                class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ config('app.name', 'Todo App') }}</span>
        </a>

        {{-- <div class="flex items-center space-x-6">
            <a href="{{ route('dashboard') }}" class="hover:text-gray-300 transition duration-300">
                Daftar Tugas
            </a>
            <a href="{{ route('tasks.create') }}" class="hover:text-gray-300 transition duration-300">
                + Tambah Tugas
            </a>
            <a href="{{ route('categories') }}" class="hover:text-gray-300 transition duration-300">
                Kelola Kategori
            </a>
        </div> --}}

        <div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>
