<div class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Header --}}
        <div class="mb-3">
            <h1 class="text-3xl font-bold mb-2 text-white">Papan Catatan</h1>
            <p class="text-gray-600">Tambahkan Papan Ringkaasan Anda</p>

        </div>

        {{-- Formulir Tambah Kategori --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Tambah Kategori Baru</h2>
            <form wire:submit.prevent="create" class="flex flex-col sm:flex-row items-end gap-4">
                <div class="flex-1 w-full">
                    <label for="category-name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" id="category-name" wire:model.defer="name"
                        placeholder="Nama kategori, cth: Pekerjaan"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                    @error('name')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full sm:w-40">
                    <label for="category-color" class="block text-sm font-medium text-gray-700 mb-1">Warna
                        (opsional)</label>
                    <input type="text" id="category-color" wire:model.defer="color" placeholder="e.g. #3B82F6"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                    @error('color')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="w-full sm:w-32">
                    <label for="category-icon" class="block text-sm font-medium text-gray-700 mb-1">Ikon
                        (opsional)</label>
                    <input type="text" id="category-icon" wire:model.defer="icon" placeholder="e.g. 📚"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-all duration-200">
                    @error('icon')
                        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full sm:w-auto px-6 py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition-colors duration-200 shadow-md">
                    Tambah
                </button>
            </form>
        </div>

        {{-- Daftar Kategori --}}
        <div class="grid gap-4">
            @forelse($categories as $cat)
                <div
                    class="p-4 rounded-xl bg-white border border-gray-200 flex items-center justify-between shadow-sm hover:border-indigo-400 transition-colors duration-200">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl" style="color: {{ $cat->color }};">{{ $cat->icon }}</span>
                        <div class="flex flex-col">
                            <span class="font-semibold text-lg text-gray-800">{{ $cat->name }}</span>
                            @if ($cat->color)
                                <span class="text-xs text-gray-500 mt-1">{{ $cat->color }}</span>
                            @endif
                        </div>
                    </div>
                    <button wire:click="delete({{ $cat->id }})"
                        class="text-rose-600 hover:text-rose-700 font-medium text-sm">
                        Hapus
                    </button>
                </div>
            @empty
                <div class="text-center p-8 bg-white rounded-xl shadow-sm border border-dashed">
                    <p class="text-gray-500 italic">Belum ada kategori. Tambahkan yang pertama!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
