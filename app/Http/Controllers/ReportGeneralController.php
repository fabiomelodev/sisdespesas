<?php

namespace App\Http\Controllers;

use App\Helpers\MonthHelper;
use App\Models\ReportGeneral;

class ReportGeneralController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(ReportGeneral $reportGeneral)
    {
        $dateCurrent = MonthHelper::getMonth($reportGeneral->month) . ' / ' . $reportGeneral->year;

        return view('pages.single-report-general', [
            'reportGeneral' => $reportGeneral,
            'dateCurrent'   => $dateCurrent
        ]);
    }
}
