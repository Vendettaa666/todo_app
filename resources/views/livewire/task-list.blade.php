<div class="py-8">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-white text-2xl font-semibold">Tugas Saya</h1>
        <a href="{{ route('tasks.create') }}" class="px-3 py-2 rounded bg-indigo-600 text-white">+ Tambah Tugas Baru</a>
    </div>

    <div class="grid gap-3">
        @forelse($tasks as $task)
            <a href="{{ route('tasks.show', $task) }}" class="p-4 rounded border bg-white hover:bg-gray-50 flex items-center justify-between">
                <div>
                    <div class="font-medium">{{ $task->title }}</div>
                    <div class="text-sm text-gray-500">{{ $task->category?->name }} @if($task->due_date) • {{ $task->due_date->format('d M Y') }} @endif</div>
                </div>
                <div class="text-xs px-2 py-1 rounded {{ $task->is_completed ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700' }}">
                    {{ $task->is_completed ? 'Selesai' : 'Belum Selesai' }}
                </div>
            </a>
        @empty
            <p class="text-gray-500 italic">Belum ada tugas. Mulai dengan menambahkan tugas baru.</p>
        @endforelse
    </div>
</div>
