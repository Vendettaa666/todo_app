<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryManager extends Component
{
    public string $name = '';
    public ?string $color = null;
    public ?string $icon = null;

    protected $rules = [
        'name' => 'required|string|min:2|max:50',
        'color' => 'nullable|string|max:20',
        'icon' => 'nullable|string|max:50',
    ];

    public function create(): void
    {
        $this->validate();
        Category::create([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'color' => $this->color,
            'icon' => $this->icon,
        ]);
        $this->reset(['name', 'color', 'icon']);
    }

    public function delete(Category $category): void
    {
        abort_unless($category->user_id === auth()->id(), 403);
        $category->delete();
    }

    public function render()
    {
        $categories = Category::where('user_id', auth()->id())->orderBy('name')->get();
        return view('livewire.category-manager', compact('categories'))->extends('layouts.app');
    }
}
