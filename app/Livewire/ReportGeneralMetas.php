<?php

namespace App\Livewire;

use App\Models\Meta;
use Livewire\Component;

class ReportGeneralMetas extends Component
{
    public $metas;

    public function mount($reportGeneral)
    {
        $this->metas = Meta::getMetasByCategoryCurrentMonth($reportGeneral->month, $reportGeneral->year);
    }

    public function render()
    {
        return view('livewire.report-general-metas');
    }
}
