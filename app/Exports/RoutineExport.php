<?php

namespace App\Exports;

use App\Models\Routine;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class RoutineExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithColumnWidths, WithTitle
{
    use RegistersEventListeners;

    private $batch,$routine_date,$teacher;

    function __construct($batch,$routine_date,$teacher)
    {
        $this->batch = $batch;
        $this->routine_date = $routine_date;
        $this->teacher = $teacher;
    }


    function title(): string
    {
        return 'Routine';
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 20,
            'C' => 20,
            'D' => 20,
            'E' => 20,
            'F' => 20,
            'G' => 20,
        ];
    }

    /**
     * @param \Maatwebsite\Excel\Events\AfterSheet $event
     */
    public static function afterSheet(AfterSheet $event)
    {
        $event->sheet->getDelegate()->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE)
            ->setPaperSize(PageSetup::PAPERSIZE_A4);



    }


    public function headings():array
    {
        return [
            'Date/Batch',
            'Class 1',
            'Class 2',
            'Class 3',
            'Class 4',
            'Class 5',
            'Class 6',
        ];
    }


    public function map($routine):array{
        return[
          $routine->routine_date."\r\n".$routine->batch->name,
            $routine->classes->where('order',1)->first()?$routine->classes->where('order',1)->first()->subject->name."\r\n".$routine->classes->where('order',1)->first()->teacher->name:'',
            $routine->classes->where('order',2)->first()?$routine->classes->where('order',2)->first()->subject->name."\r\n".$routine->classes->where('order',2)->first()->teacher->name:'',
            $routine->classes->where('order',3)->first()?$routine->classes->where('order',3)->first()->subject->name."\r\n".$routine->classes->where('order',3)->first()->teacher->name:'',
            $routine->classes->where('order',4)->first()?$routine->classes->where('order',4)->first()->subject->name."\r\n".$routine->classes->where('order',4)->first()->teacher->name:'',
            $routine->classes->where('order',5)->first()?$routine->classes->where('order',5)->first()->subject->name."\r\n".$routine->classes->where('order',5)->first()->teacher->name:'',
            $routine->classes->where('order',6)->first()?$routine->classes->where('order',6)->first()->subject->name."\r\n".$routine->classes->where('order',6)->first()->teacher->name:'',
        ];
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $routines = Routine::with('batch','classes','classes.teacher','classes.subject')->owned();

        if ($this->batch) {
            $routines = $routines->where('batch_id', $this->batch);
        }

        if ($this->routine_date) {
            $routines = $routines->where('routine_date', $this->routine_date);
        }


        if($this->teacher){
            $routines = $routines->whereHas('classes.teacher', function ($q) {
                return $q->where('id', $this->teacher);
            });
        }

        $routines = $routines->latest('routine_date')->get();

        if($this->teacher){
            $routines=$routines->map(function ($routine) {
                $routine->classes = $routine->classes->filter(function ($class) {
                    return $class->teacher_id == $this->teacher;
                });
                return $routine;
            });
        }

        return $routines;
    }
}
