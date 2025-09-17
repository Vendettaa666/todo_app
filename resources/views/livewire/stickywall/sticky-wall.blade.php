<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Papan Catatan</h1>

    <form wire:submit="saveNote" class="mb-8">
        <textarea wire:model="newNoteContent" placeholder="Tulis catatan baru..."
            class="w-full p-4 rounded-lg shadow-inner focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        @error('newNoteContent')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
        <button type="submit"
            class="mt-2 px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition duration-300">
            Simpan Catatan
        </button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach ($notes as $note)
            <div class="p-6 rounded-lg shadow-md relative" style="background-color: #fff9c4;">
                <p>{{ $note->content }}</p>
                </div>
        @endforeach
    </div>
</div>
