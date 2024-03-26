<?php

namespace App\Livewire;

use App\Models\Expense;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ExpensesStatus extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public function delete($id)
    {
        $expense = Expense::find($id);

        $expense->delete();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $expenses_paid = Expense::where('status', 'pago')
                            // ->whereYear('due_date', Carbon::now()->year)
                            // ->whereMonth('due_date', Carbon::now()->month)
                            ->get();

        $expenses_pending = Expense::where('status', 'pendente')
                            // ->whereYear('due_date', Carbon::now()->year)
                            // ->whereMonth('due_date', Carbon::now()->month)
                            ->get();

        return view('livewire.expenses-status', [
            'expenses_paid'    => $expenses_paid,
            'expenses_pending' => $expenses_pending
        ]);
    }
}
