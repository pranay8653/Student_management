<?php

namespace App\Exports;

use App\Models\Result;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentResultExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Result::with('department_name')->with('student')->get();
    }

    public function map($result) : array {
        return [
            $result->student->first_name,
            $result->student->last_name,
            $result->sub_1,
            $result->sub_2,
            $result->sub_3,
            $result->sub_4,
            $result->sub_5,
            $result->sub_6,
            $result->sub_7,
            $result->total,
            $result->percentage,
            $result->grade,
            Carbon::parse($result->created_at)->toFormattedDateString(),
        ];
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Marks Of Subject 1',
            'Marks Of Subject 2',
            'Marks Of Subject 3',
            'Marks Of Subject 4',
            'Marks Of Subject 5',
            'Marks Of Subject 6',
            'Marks Of Subject 7',
            'Total',
            'Overall Percentage',
            'Overall Gread',
            'Created'
        ];
    }

}
