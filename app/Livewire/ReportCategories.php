<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use App\Models\Expense;
use App\Models\ImmediateExpense;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReportCategories extends Component
{
    public $categories;

    public string $year;

    public string $month;

    public $expenses;

    public $expensesTotal;

    public function mount(string $year, string $month)
    {
        $this->year = $year;

        $this->month = $month;

        $this->getCategories();
    }

    public function getCategories()
    {
        // $this->categories = Expense::join('categories', 'expenses.category_id', '=', 'categories.id')
        //     ->selectRaw('categories.title, SUM(expenses.value) as total')
        //     ->selectRaw('categories.id as category_id')
        //     ->when($this->month != null, function (Builder $query) {
        //         return $query->whereMonth('expenses.pay_day', $this->month);
        //     })->groupBy('categories.id')
        //     ->when($this->year != null, function (Builder $query) {
        //         return $query->whereYear('expenses.pay_day', $this->year);
        //     })->groupBy('categories.id')
        //     ->where('expenses.user_id', Auth::user()->id)
        //     ->orderBy('title', 'asc')
        //     ->get();


        $this->categories = Category::orderBy('title', 'asc')
            ->get()
            ->map(function ($category) {
                $immediateExpenses = $category->immediateExpenses()
                    ->whereMonth('pay_day', $this->month)
                    ->whereYear('pay_day', $this->year)
                    ->where('status', 'pago')
                    ->get();

                $credits = $category->credits()
                    ->whereMonth('pay_day', $this->month)
                    ->whereYear('pay_day', $this->year)
                    ->get();

                $totalExpenses = $immediateExpenses->sum('value') + $credits->sum('value');

                return [
                    'id'                => $category->id,
                    'title'             => $category->title,
                    'totalExpenses'     => $totalExpenses,
                ];
            });
    }

    public function updateExpenses($categoryId)
    {
        $this->expenses = ImmediateExpense::whereRelation('category', 'id', $categoryId)
            ->whereYear('pay_day', $this->year)
            ->whereMonth('pay_day', $this->month)
            ->get();

        $this->expensesTotal = ImmediateExpense::whereRelation('category', 'id', $categoryId)
            ->whereYear('pay_day', $this->year)
            ->whereMonth('pay_day', $this->month)
            ->sum('value');

        $this->getCategories();
    }

    public function render()
    {
        return view('livewire.report-categories', [
            'categories' => $this->categories
        ]);
    }
}
