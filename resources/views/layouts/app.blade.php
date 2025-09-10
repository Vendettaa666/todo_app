<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskify</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <nav class="mb-6">
            <a href="{{ route('dashboard') }}" class="mr-4 text-blue-600">Dashboard</a>
            <a href="{{ route('tasks.create') }}" class="mr-4 text-blue-600">+ Tambah Tugas</a>
            <a href="{{ route('categories') }}" class="mr-4 text-blue-600">Kelola Kategori</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-red-600">Logout</button>
            </form>
        </nav>

        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>
