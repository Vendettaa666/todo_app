<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\StickyNote;
use Livewire\Attributes\Rule;

class StickyWall extends Component
{
    public $notes;

    #[Rule('required', 'min:5')]
    public $newNoteContent = '';

    public function mount()
    {
        $this->notes = StickyNote::where('user_id', auth()->id())->latest()->get();
    }

    public function saveNote()
    {
        $this->validate();

        StickyNote::create([
            'content' => $this->newNoteContent,
            'user_id' => auth()->id(),
        ]);

        $this->reset('newNoteContent');
        $this->notes = StickyNote::where('user_id', auth()->id())->latest()->get();
    }

    public function render()
    {
        return view('livewire.stickywall.sticky-wall')->extends('layouts.app');;
    }
}
