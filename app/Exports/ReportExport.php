<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportExport implements FromView, WithEvents
{
    use RegistersEventListeners;

    public $teacherBatchRoutine,$from_date,$to_date,$selectedBatches;

    function __construct($teacherBatchRoutine, $from_date, $to_date,$selectedBatches)
    {
        $this->teacherBatchRoutine = $teacherBatchRoutine;
        $this->selectedBatches = $selectedBatches;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

        /**
     * @param \Maatwebsite\Excel\Events\AfterSheet $event
     */
    public static function afterSheet(AfterSheet $event)
    {
        $highestColumn = $event->sheet->getDelegate()->getHighestColumn();
        $highestColumn++;
        for ($column = 'A'; $column !== $highestColumn; $column++) {
            $event->sheet->getDelegate()->getColumnDimension($column)->setWidth(20);
        }
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
