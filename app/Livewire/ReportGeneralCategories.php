<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\ImmediateExpense;
use Livewire\Component;

class ReportGeneralCategories extends Component
{
    public $categories;

    public string $year;

    public string $month;

    public $expenses;

    public $expensesTotal;

    public function mount($reportGeneral)
    {
        $this->year = $reportGeneral->year;

        $this->month = $reportGeneral->month;

        $this->getCategories();
    }

    public function getCategories()
    {
        $this->categories = Category::orderBy('title', 'asc')
            ->get()
            ->map(function ($category) {
                if ($category->immediateExpenses()->whereMonth('pay_day', $this->month)->whereYear('pay_day', $this->year)->where('status', 'pago')->exists()) {
                    $immediateExpenses = $category->immediateExpenses()
                        ->whereMonth('pay_day', $this->month)
                        ->whereYear('pay_day', $this->year)
                        ->where('status', 'pago')
                        ->get();

                    $totalExpenses = $immediateExpenses->sum('value');

                    return [
                        'id'                => $category->id,
                        'title'             => $category->title,
                        'totalExpenses'     => $totalExpenses,
                    ];
                }

                return [];
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
        return view('livewire.report-general-categories', [
            'categories' => $this->categories
        ]);
    }
}
