<?php

namespace App\Livewire\Expenses;

use App\Models\Category;
use App\Models\Expense;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class ExpenseCategory extends Component
{
    public string $searchCategory = '';

    public $expense;

    public function mount(Expense $expense)
    {
        $this->expense = $expense;
    }

    // public function chooseCategory($id)
    // {
    //     $this->emitUp('updateCategory');
    // }

    public function render()
    {
        $categories = Category::when($this->searchCategory, fn (Builder $query) => $query->where('title', 'like', '%'. $this->searchCategory .'%'))
                        ->orderBy('title', 'asc')
                        ->get();

        return view('livewire.expenses.expense-category', [
            'categories' => $categories
        ]);
    }
}
