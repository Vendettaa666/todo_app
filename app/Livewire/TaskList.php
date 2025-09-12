<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskList extends Component
{
    public function render()
    {
        $tasks = Task::where('user_id', auth()->id())
                    ->with('category')
                    ->latest()
                    ->get();

        return view('livewire.task-list', [
            'tasks' => $tasks
        ]);
    }
}
