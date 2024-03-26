<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class CategoryTable extends Component
{
    public string $searchCategory = '';

    public function mount(): void
    {
    }

    public function delete(string $id)
    {

    }

    public function render()
    {
        $categories = Category::when($this->searchCategory != null, fn (Builder $query) => $query->where('title', 'like', '%' . $this->searchCategory . '%'))
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('livewire.category-table', ['categories' => $categories]);
    }
}
