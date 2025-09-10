<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoTaskSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();

        $category = Category::create([
            'user_id' => $user->id,
            'name' => 'Pekerjaan',
            'color' => '#ef4444',
            'icon' => 'fa-briefcase'
        ]);

        $task = Task::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Selesaikan laporan Q2',
            'description' => 'Laporan untuk direksi',
            'priority' => 'high',
            'due_date' => now()->addDays(3),
            'is_completed' => false
        ]);

        // Tambahkan catatan
        $task->note()->create([
            'content' => 'Pastikan data penjualan sudah di-validasi oleh tim finance sebelum submit.'
        ]);
    }
}
