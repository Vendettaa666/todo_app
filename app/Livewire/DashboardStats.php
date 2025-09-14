<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\Category;

class DashboardStats extends Component
{
    public function render()
    {
        $userId = auth()->id();

        // Get task statistics
        $totalTasks = Task::where('user_id', $userId)->count();
        $completedTasks = Task::where('user_id', $userId)->where('is_completed', true)->count();
        $pendingTasks = Task::where('user_id', $userId)->where('is_completed', false)->count();

        // Get tasks by priority
        $highPriorityTasks = Task::where('user_id', $userId)
            ->where('priority', 'high')
            ->where('is_completed', false)
            ->count();

        $mediumPriorityTasks = Task::where('user_id', $userId)
            ->where('priority', 'medium')
            ->where('is_completed', false)
            ->count();

        $lowPriorityTasks = Task::where('user_id', $userId)
            ->where('priority', 'low')
            ->where('is_completed', false)
            ->count();

        // Get overdue tasks
        $overdueTasks = Task::where('user_id', $userId)
            ->where('is_completed', false)
            ->where('due_date', '<', now())
            ->count();

        // Get tasks due today
        $dueTodayTasks = Task::where('user_id', $userId)
            ->where('is_completed', false)
            ->whereDate('due_date', today())
            ->count();

        // Get tasks by category
        $tasksByCategory = Category::where('user_id', $userId)
            ->withCount(['tasks' => function ($query) {
                $query->where('is_completed', false);
            }])
            ->get();

        // Calculate completion percentage
        $completionPercentage = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 1) : 0;

        return view('livewire.dashboard-stats', [
            'totalTasks' => $totalTasks,
            'completedTasks' => $completedTasks,
            'pendingTasks' => $pendingTasks,
            'highPriorityTasks' => $highPriorityTasks,
            'mediumPriorityTasks' => $mediumPriorityTasks,
            'lowPriorityTasks' => $lowPriorityTasks,
            'overdueTasks' => $overdueTasks,
            'dueTodayTasks' => $dueTodayTasks,
            'tasksByCategory' => $tasksByCategory,
            'completionPercentage' => $completionPercentage,
        ]);
    }
}
