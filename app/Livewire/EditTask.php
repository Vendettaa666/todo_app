<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Category;

class EditTask extends Component
{
    public Task $task;

    public string $title = '';
    public ?string $description = null;
    public ?int $category_id = null;
    public ?string $due_date = null;
    public string $priority = 'medium';

    protected function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'nullable|exists:categories,id',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
        ];
    }

    public function mount(Task $task): void
    {
        abort_unless($task->user_id === auth()->id(), 403);
        $this->task = $task;
        $this->title = $task->title;
        $this->description = $task->description;
        $this->category_id = $task->category_id;
        $this->due_date = $task->due_date ? $task->due_date->format('Y-m-d') : null;
        $this->priority = $task->priority;
    }

    public function update(): void
    {
        $this->validate();

        $this->task->update([
            'title' => $this->title,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'due_date' => $this->due_date,
            'priority' => $this->priority,
        ]);

        session()->flash('status', 'Tugas berhasil diperbarui');
        $this->redirect(route('tasks.show', $this->task));
    }

    public function render()
    {
        $categories = Category::where('user_id', auth()->id())->orderBy('name')->get();
        return view('livewire.task-list.edit-task', compact('categories'))->extends('layouts.app');
    }
}


