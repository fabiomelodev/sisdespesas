<?php

namespace App\Livewire;

use App\Helpers\MonthHelper;
use App\Models\Category;
use App\Models\Expense;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PanelCategories extends Component
{
    public $months;

    public $monthCurrent;

    public $search;

    public $month;

    public $year;

    public function __construct()
    {
        $this->months = MonthHelper::getMonths();

        $this->monthCurrent = MonthHelper::getMonthCurrent();

        $this->month = Carbon::now()->month;

        $this->year = Carbon::now()->year;
    }

    public function render()
    {
        $expensesCategories = Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
            ->selectRaw('categories.title, SUM(expenses.value) as total')
            ->selectRaw('categories.id as category_id')
            ->when($this->search != null, fn (Builder $query) => $query->where('categories.title', 'like', '%' . $this->search . '%'))
            ->when($this->month != null, fn (Builder $query) => $query->whereMonth('expenses.pay_day', $this->month))->groupBy('categories.id')
            ->when($this->month != null, fn (Builder $query) => $query->whereYear('expenses.pay_day', $this->year))->groupBy('categories.id')
            ->where('expenses.user_id', Auth::user()->id)
            ->orderBy('title', 'asc')
            ->get();

        $categories = Category::when($this->search != null, fn (Builder $query) => $query->where('title', 'like', '%' . $this->search . '%'))
            ->where('user_id', Auth::user()->id)
            ->orderBy('title', 'asc')
            ->get();

        $categories_count = $categories->count();

        return view('livewire.panel-categories', [
            'expensesCategories' => $expensesCategories,
            'categories_count'   => $categories_count
        ]);
    }
}
