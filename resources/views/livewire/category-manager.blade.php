<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-semibold mb-6">Manajemen Kategori</h1>

    <form wire:submit.prevent="create" class="flex items-end gap-3 mb-6">
        <div class="flex-1">
            <label class="block text-sm font-medium">Nama</label>
            <input type="text" wire:model.defer="name" class="mt-1 w-full border rounded p-2">
            @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Warna (opsional)</label>
            <input type="text" wire:model.defer="color" placeholder="#AABBCC / red-500" class="mt-1 w-40 border rounded p-2">
            @error('color')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium">Ikon (opsional)</label>
            <input type="text" wire:model.defer="icon" placeholder="e.g. 📚" class="mt-1 w-32 border rounded p-2">
            @error('icon')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="h-10 px-4 rounded bg-indigo-600 text-white">Tambah</button>
    </form>

    <div class="grid gap-2">
        @forelse($categories as $cat)
            <div class="p-3 rounded border flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span>{{ $cat->icon }}</span>
                    <span class="font-medium">{{ $cat->name }}</span>
                    @if($cat->color)
                        <span class="text-xs text-gray-500">{{ $cat->color }}</span>
                    @endif
                </div>
                <button wire:click="delete({{ $cat->id }})" class="text-rose-600 hover:text-rose-700">Hapus</button>
            </div>
        @empty
            <p class="text-gray-500">Belum ada kategori.</p>
        @endforelse
    </div>
</div>

