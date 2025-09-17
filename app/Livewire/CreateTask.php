<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Task;
use App\Models\Category;
use App\Models\TaskAttachment;
use App\Models\TaskNote;

class CreateTask extends Component
{
    use WithFileUploads;

    public string $title = '';
    public ?string $description = null;
    public ?int $category_id = null;
    public ?string $due_date = null;
    public string $priority = 'medium';
    public array $attachments = [];
    public ?string $note_content = null;

    protected function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'nullable|exists:categories,id',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high',
            'attachments.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,pdf',
            'note_content' => 'nullable|string',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $task = Task::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category_id,
            'title' => $this->title,
            'description' => $this->description,
            'priority' => $this->priority,
            'due_date' => $this->due_date,
            'is_completed' => false,
        ]);

        if (!empty($this->attachments)) {
            foreach ($this->attachments as $file) {
                $storedPath = $file->store('attachments', 'public');
                TaskAttachment::create([
                    'task_id' => $task->id,
                    'file_path' => $storedPath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientOriginalExtension(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        if ($this->note_content) {
            TaskNote::create([
                'task_id' => $task->id,
                'content' => $this->note_content,
            ]);
        }

        session()->flash('status', 'Tugas berhasil dibuat');
        $this->redirect(route('tasks.show', $task));
    }

    public function render()
    {
        $categories = Category::where('user_id', auth()->id())->orderBy('name')->get();
        return view('livewire.task-list.create-task', compact('categories'))->extends('layouts.app');
    }
}
