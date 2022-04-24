<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;


class ReportExport implements FromView
{
    public $teacherBatchRoutine,$from_date,$to_date,$selectedBatches,$batch_class_count;

    function __construct($teacherBatchRoutine, $from_date, $to_date,$selectedBatches,$batch_class_count)
    {
        $this->teacherBatchRoutine = $teacherBatchRoutine;
        $this->selectedBatches = $selectedBatches;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->batch_class_count = $batch_class_count;
    }

    public function view(): View
    {
        return view('exports.reports', [
            'teacherBatchRoutine' => $this->teacherBatchRoutine,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'selectedBatches' => $this->selectedBatches,
            'batch_class_count' => $this->batch_class_count,
        ]);
    }
}
