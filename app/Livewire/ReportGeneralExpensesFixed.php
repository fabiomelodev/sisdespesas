<?php

namespace App\Livewire;

use App\Models\ImmediateExpense;
use Livewire\Component;

class ReportGeneralExpensesFixed extends Component
{
    public $expensesFixedPeding;

    public $expensesFixedPedingTotalValues;

    public $expensesFixedPaid;

    public $expensesFixedPaidTotalValues;

    public function mount($reportGeneral)
    {
        $this->expensesFixedPeding = ImmediateExpense::getExpensesFixedPedingCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $this->expensesFixedPedingTotalValues = $this->expensesFixedPeding->sum(fn($expense) => is_numeric($expense->value) ? (float) $expense->value : 0);

        $this->expensesFixedPaid = ImmediateExpense::getExpensesFixedPaidCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $this->expensesFixedPaidTotalValues = $this->expensesFixedPaid->sum(fn($expense) => (float) $expense->value);
    }

    public function render()
    {
        return view('livewire.report-general-expenses-fixed');
    }
}
