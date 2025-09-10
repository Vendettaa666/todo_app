<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskDetail extends Component
{
    public Task $task;

    public function mount(Task $task): void
    {
        abort_unless($task->user_id === auth()->id(), 403);
        $this->task = $task->load(['category', 'attachments', 'note']);
    }

    public function toggleComplete(): void
    {
        $this->task->update(['is_completed' => ! $this->task->is_completed]);
        $this->task->refresh();
    }

    public function delete(): void
    {
        $this->task->delete();
        session()->flash('status', 'Tugas dihapus');
        $this->redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.task-detail')->extends('layouts.app');
    }
}
