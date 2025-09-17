<div class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Tugas</h1>

        {{-- Notifikasi Sukses --}}
        @if (session('status'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 font-medium">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            {{-- Form --}}
            <form wire:submit.prevent="update" class="space-y-6">
                {{-- Judul dan Deskripsi --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Tugas</label>
                    <input type="text" id="title" wire:model.defer="title" placeholder="Tuliskan judul tugas di sini" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                    @error('title')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea id="description" wire:model.defer="description" rows="4" placeholder="Jelaskan detail tugas" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200"></textarea>
                    @error('description')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Kolom Kategori, Deadline, dan Prioritas --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select id="category" wire:model="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                            <option value="">Pilih kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Tenggat</label>
                        <input type="date" id="due_date" wire:model="due_date" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                        @error('due_date')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Prioritas</label>
                        <select id="priority" wire:model="priority" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                            <option value="low">Rendah</option>
                            <option value="medium">Sedang</option>
                            <option value="high">Tinggi</option>
                        </select>
                        @error('priority')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Catatan (jika ada) --}}
                @if ($task->note)
                    <div>
                        <label for="note_content" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                        <textarea id="note_content" wire:model.defer="note_content" rows="4" placeholder="Tambahkan catatan tambahan untuk tugas ini" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200"></textarea>
                        @error('note_content')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                @endif

                {{-- Lampiran (jika ada) --}}
                @if ($task->attachments->count() > 0)
                    <div class="border-t pt-6 mt-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Lampiran yang Ada</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($task->attachments as $file)
                                <div class="relative p-4 rounded-lg bg-gray-50 border border-gray-200 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span class="text-sm text-gray-700 truncate">{{ $file->file_name }}</span>
                                    </div>
                                    <button wire:click="deleteAttachment({{ $file->id }})" onclick="return confirm('Hapus lampiran ini?')" class="text-rose-500 hover:text-rose-700 text-sm font-medium">Hapus</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Tambah Lampiran Baru --}}
                <div class="border-t pt-6 mt-6">
                    <div>
                        <label for="new_attachments" class="block text-sm font-medium text-gray-700 mb-1">Tambah Lampiran Baru</label>
                        <input type="file" id="new_attachments" wire:model="newAttachments" multiple class="w-full text-gray-900 border border-gray-300 rounded-lg shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors duration-200">
                        @error('newAttachments.*')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                        <div class="text-xs text-gray-500 mt-1">Maks. 5MB per file (JPG/PNG/PDF).</div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-colors duration-200 shadow-md">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('tasks.show', $this->task) }}" class="px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-100 text-gray-700 font-medium transition-colors duration-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
