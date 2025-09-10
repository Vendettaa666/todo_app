<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Edit Tugas</h1>

    @if (session('status'))
        <div class="mb-4 p-3 rounded bg-green-50 text-green-700">{{ session('status') }}</div>
    @endif

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label class="block text-sm font-medium">Judul</label>
            <input type="text" wire:model.defer="title" class="mt-1 w-full border rounded p-2">
            @error('title')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Deskripsi</label>
            <textarea wire:model.defer="description" rows="3" class="mt-1 w-full border rounded p-2"></textarea>
            @error('description')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium">Kategori</label>
                <select wire:model="category_id" class="mt-1 w-full border rounded p-2">
                    <option value="">Pilih kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Deadline</label>
                <input type="date" wire:model="due_date" class="mt-1 w-full border rounded p-2">
                @error('due_date')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Prioritas</label>
                <select wire:model="priority" class="mt-1 w-full border rounded p-2">
                    <option value="low">Rendah</option>
                    <option value="medium">Sedang</option>
                    <option value="high">Tinggi</option>
                </select>
                @error('priority')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-4 py-2 rounded bg-indigo-600 text-white">Simpan</button>
            <a href="{{ route('tasks.show', $this->task) }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>


