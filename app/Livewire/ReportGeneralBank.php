<?php

namespace App\Livewire;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ReportGeneralBank extends Component
{
    public $reportGeneral;

    public $banks;

    public $layout = 'swiper';

    public function mount($reportGeneral)
    {
        $this->reportGeneral = $reportGeneral;

        $this->banks = Bank::getTotalBankValueCurrentMonth($reportGeneral->month, $reportGeneral->year);
    }

    public function changeLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render()
    {
        return view('livewire.report-general-bank');
    }
}
