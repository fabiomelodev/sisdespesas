<?php

namespace App\Livewire;

use App\Models\CardCredit;
use App\Models\Invoice;
use Livewire\Component;

class ReportGeneralCredits extends Component
{
    public $cardCredits;

    public $invoicesNextMonth;

    public $invoicesNextMonthTotalValues;

    public function mount($reportGeneral)
    {
        $this->cardCredits = CardCredit::getCardCreditsTotalCurrentMonth($reportGeneral->month, $reportGeneral->year);

        $this->invoicesNextMonth = Invoice::whereMonth('due_date', $reportGeneral->month + 1)
            ->whereYear('due_date', $reportGeneral->year)
            ->get();

        $this->invoicesNextMonthTotalValues = $this->invoicesNextMonth->sum('value');
    }

    public function render()
    {
        return view('livewire.report-general-credits');
    }
}
