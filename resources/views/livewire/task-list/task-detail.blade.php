<div class="max-w-4xl mx-auto p-6 lg:p-10 bg-white rounded-xl shadow-lg">
    {{-- Header dan Tombol Aksi --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 pb-4 border-b">
        <div class="mb-4 sm:mb-0">
            <div class="flex items-center gap-3">
                <h1 class="text-3xl font-bold text-gray-800">{{ $task->title }}</h1>
                @if($task->is_completed)
                    <span class="text-xs px-2 py-1 rounded-full bg-emerald-100 text-emerald-700 font-semibold">Selesai</span>
                @else
                    <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700 font-semibold">Belum Selesai</span>
                @endif
            </div>
            <div class="text-gray-500 mt-1 text-sm">
                {{ $task->category?->name }} @if($task->due_date) • Tenggat: {{ $task->due_date->format('d M Y') }} @endif
            </div>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('tasks.edit', $task) }}" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition-colors duration-200 shadow-md">
                Edit
            </a>
            <button wire:click="toggleComplete" class="px-4 py-2 rounded-lg {{ $task->is_completed ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-amber-600 hover:bg-amber-700' }} text-white font-medium transition-colors duration-200 shadow-md">
                {{ $task->is_completed ? 'Tandai Belum Selesai' : 'Selesaikan Tugas' }}
            </button>
            <button wire:click="delete" onclick="return confirm('Hapus tugas ini?')" class="px-4 py-2 rounded-lg bg-rose-600 hover:bg-rose-700 text-white font-medium transition-colors duration-200 shadow-md">
                Hapus
            </button>
        </div>
    </div>

    {{-- Detail Deskripsi dan Catatan --}}
    <div class="space-y-6">
        @if($task->description)
            <div class="p-5 bg-gray-50 rounded-lg shadow-sm">
                <h2 class="font-bold text-lg mb-2 text-gray-700">Deskripsi</h2>
                <p class="text-gray-600 leading-relaxed">{{ $task->description }}</p>
            </div>
        @endif

        <div class="p-5 bg-gray-50 rounded-lg shadow-sm">
            <h2 class="font-bold text-lg mb-2 text-gray-700">Catatan</h2>
            <div class="prose max-w-none text-gray-600">
                {{ $task->note?->content ? $task->note->content : 'Tidak ada catatan.' }}
            </div>
        </div>

        {{-- Lampiran --}}
        <div>
            <h2 class="font-bold text-lg mb-4 text-gray-700">Lampiran</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($task->attachments as $file)
                    <a href="{{ Storage::disk('public')->url($file->file_path) }}" target="_blank" class="p-4 rounded-lg border border-gray-200 hover:bg-gray-100 transition-colors duration-200 flex flex-col justify-between shadow-sm">
                        <div class="flex items-center gap-2 mb-2">
                            {{-- Placeholder untuk ikon, ganti dengan ikon sesuai tipe file jika perlu --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="font-medium text-gray-800 break-all">{{ $file->file_name }}</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">{{ strtoupper($file->file_type) }} • {{ number_format($file->file_size / 1024, 1) }} KB</span>
                    </a>
                @empty
                    <p class="text-gray-500 italic">Tidak ada lampiran.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
