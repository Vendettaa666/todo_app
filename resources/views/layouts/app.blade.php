<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taskify</title>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900">
    <livewire:layout.navigation>
    <div class="flex">
        <aside class="bg-gray-800 text-white w-64 min-h-screen p-6 shadow-md">
            <livewire:components.sidebar>
        </aside>
        <main class="flex-1 container mx-auto px-4 py-8">
            @yield('content')
        </main>
    </div>

    @livewireScripts
</body>
</html>
