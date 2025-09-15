<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header dan Tombol --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Daftar Tugas</h1>
            <a href="{{ route('tasks.create') }}" class="mt-4 sm:mt-0 px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-colors duration-200 shadow-md transform hover:scale-105">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Tugas Baru
                </div>
            </a>
        </div>

        {{-- Daftar Tugas --}}
        <div class="grid gap-4 lg:grid-cols-2 xl:grid-cols-3">
            @forelse($tasks as $task)
                <a href="{{ route('tasks.show', $task) }}" class="block p-6 rounded-xl bg-white border border-gray-200 hover:border-indigo-400 hover:bg-gray-50 transition-all duration-200 shadow-sm">
                    <div class="flex items-start justify-between">
                        <div class="pr-4">
                            <div class="text-lg font-semibold text-gray-800 mb-1">{{ $task->title }}</div>
                            <div class="text-sm text-gray-500 flex items-center gap-2">
                                <span>{{ $task->category?->name }}</span>
                                @if($task->due_date)
                                    <span class="text-gray-400">|</span>
                                    <span>Tenggat: {{ $task->due_date->format('d M Y') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="text-xs px-3 py-1 rounded-full font-semibold {{ $task->is_completed ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                {{ $task->is_completed ? 'Selesai' : 'Belum Selesai' }}
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="lg:col-span-3 text-center p-8 bg-white rounded-xl shadow-sm border border-dashed">
                    <p class="text-gray-500 italic">Belum ada tugas. Mulai dengan menambahkan tugas baru!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
