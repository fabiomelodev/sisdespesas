<?php

namespace App\Livewire;

use App\Models\{Category, Expense};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ExpenseTable extends Component
{
    public string $searchCategory = '';

    public string $categoryFilter = '';

    public string $payDayStartFilter = '';

    public string $payDayEndFilter = '';

    public $categoriesFilter = null;

    public function mount(): void
    {
        $this->categoriesFilter = Category::orderBy('title', 'asc')->get();

        $this->filterClear();
    }

    public function delete($id): void
    {
        if(Expense::find($id)) {
            Expense::find($id)->delete();

            session()->flash('message', 'Excluído com sucesso!');
        }
    }

    public function filterClear(): void
    {
        $this->categoryFilter = '';
        $this->payDayStartFilter = '';
        $this->payDayEndFilter = '';
    }

    public function render()
    {
        $expenses = Expense::when($this->searchCategory != null, fn (Builder $query) => $query->where('title', 'like', '%' . $this->searchCategory . '%'))
                        ->when($this->categoryFilter != '', fn (Builder $query) => $query->whereRelation('category', 'title', $this->categoryFilter))
                        ->when($this->payDayStartFilter != '', fn (Builder $query) => $query->whereDate('pay_day', '>=', $this->payDayStartFilter))
                        ->when($this->payDayEndFilter != '', fn (Builder $query) => $query->whereDate('pay_day', '<=', $this->payDayEndFilter))
                        ->orderBy('pay_day', 'desc')
                        ->get();

        $expenses_month_current = Expense::orderBy('pay_day', 'desc')
                                            ->whereMonth('pay_day', Carbon::now()->month)
                                            ->get();

        $expenses_values = [];

        $expenses_month_current_values = [];

        foreach($expenses as $expense) {
            array_push($expenses_values, $expense->value);
        }

        $expenses_sum_values = [];

        $expenses_sum_values = array_sum($expenses_values);

        foreach($expenses_month_current as $expense_month_current) {
            array_push($expenses_month_current_values, $expense_month_current->value);
        }

        $expenses_month_current_sum_values = [];

        $expenses_month_current_sum_values = array_sum($expenses_month_current_values);

        return view('livewire.expense-table', [
            'expenses'                          => $expenses,
            'expenses_sum_values'               => $expenses_sum_values,
            'expenses_month_current_sum_values' => $expenses_month_current_sum_values
        ]);
    }
}
