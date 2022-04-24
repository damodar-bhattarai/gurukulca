<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class ReportExport implements FromView
{
    public $teacherBatchRoutine,$from_date,$to_date,$selectedBatches;

    function __construct($teacherBatchRoutine, $from_date, $to_date,$selectedBatches)
    {
        $this->teacherBatchRoutine = $teacherBatchRoutine;
        $this->selectedBatches = $selectedBatches;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function view(): View
    {
        return view('exports.reports', [
            'teacherBatchRoutine' => $this->teacherBatchRoutine,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'selectedBatches' => $this->selectedBatches,
        ]);
    }
}
