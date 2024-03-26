<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class FilterCategory extends Component
{
    public $filterYear;
    public $filterMonth;
    public $filterCategory;

    public function mount(): void
    {

    }

    public function render()
    {
        $categories = Category::orderBy('title', 'asc')->get();

        if($this->filterYear != null && $this->filterMonth) {
            $expenses = Expense::whereYear('pay_day', $this->filterYear)
                            ->whereMonth('pay_day', $this->filterMonth)
                            ->get();

            dd(false, $expenses);

            return view('livewire.filter-category', [
                'categories' => $categories,
                'expenses'   => $expenses
            ]);
        }

        if($this->filterCategory != null) {
            $expenses = Expense::whereRelation('category', 'title', $this->filterCategory)
                            ->whereYear('pay_day', $this->filterYear)
                            ->whereMonth('pay_day', $this->filterMonth)
                            ->get();

            dd(true, $expenses);

            return view('livewire.filter-category', [
                'categories' => $categories,
                'expenses'   => $expenses
            ]);
        }

        return view('livewire.filter-category', ['categories' => $categories]);
    }
}
