<div class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Buat Tugas Baru</h1>

        {{-- Notifikasi Sukses --}}
        @if (session('status'))
            <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800 font-medium">
                {{ session('status') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
            {{-- Form --}}
            <form wire:submit.prevent="save" class="space-y-6" enctype="multipart/form-data">
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

                {{-- Lampiran dan Catatan --}}
                <div>
                    <label for="attachments" class="block text-sm font-medium text-gray-700 mb-1">Lampiran</label>
                    <input type="file" id="attachments" wire:model="attachments" multiple class="w-full text-gray-900 border border-gray-300 rounded-lg shadow-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors duration-200">
                    @error('attachments.*')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                    <div class="text-xs text-gray-500 mt-1">Maks. 5MB per file (JPG/PNG/PDF).</div>
                </div>

                <div>
                    <label for="note_content" class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                    <textarea id="note_content" wire:model.defer="note_content" rows="4" placeholder="Tambahkan catatan tambahan untuk tugas ini" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200"></textarea>
                    @error('note_content')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-colors duration-200 shadow-md">
                        Simpan Tugas
                    </button>
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-100 text-gray-700 font-medium transition-colors duration-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
