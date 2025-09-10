<div class="max-w-4xl mx-auto py-8">
    <div class="flex items-start justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold">{{ $task->title }}</h1>
            <div class="text-gray-500">{{ $task->category?->name }} @if($task->due_date) • {{ $task->due_date->format('d M Y') }} @endif</div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('tasks.edit', $task) }}" class="px-3 py-2 rounded bg-blue-600 text-white">Edit</a>
            <button wire:click="toggleComplete" class="px-3 py-2 rounded {{ $task->is_completed ? 'bg-emerald-600' : 'bg-amber-600' }} text-white">
                {{ $task->is_completed ? 'Tandai Belum Selesai' : 'Selesaikan Tugas' }}
            </button>
            <button wire:click="delete" onclick="return confirm('Hapus tugas ini?')" class="px-3 py-2 rounded bg-rose-600 text-white">Hapus</button>
        </div>
    </div>

    @if($task->description)
        <div class="mb-4">
            <h2 class="font-medium mb-1">Deskripsi</h2>
            <p class="text-gray-700">{{ $task->description }}</p>
        </div>
    @endif

    <div class="mb-4">
        <h2 class="font-medium mb-1">Catatan</h2>
        <div class="prose max-w-none">{{ $task->note?->content }}</div>
    </div>

    <div>
        <h2 class="font-medium mb-2">Lampiran</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            @forelse($task->attachments as $file)
                <a href="{{ Storage::disk('public')->url($file->file_path) }}" target="_blank" class="p-3 rounded border flex items-center justify-between">
                    <span>{{ $file->file_name }}</span>
                    <span class="text-xs text-gray-500">{{ strtoupper($file->file_type) }} • {{ number_format($file->file_size / 1024, 1) }} KB</span>
                </a>
            @empty
                <p class="text-gray-500">Tidak ada lampiran</p>
            @endforelse
        </div>
    </div>
</div>

