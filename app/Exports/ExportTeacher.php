<?php

namespace App\Exports;

use App\Models\Teacher;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportTeacher implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return  Teacher::with('department')->get();
    }

    public function map($teacher) : array {
        return [
            $teacher->first_name,
            $teacher->last_name,
            $teacher->email,
            $teacher->phone,
            $teacher->address,
            $teacher->dob,
            $teacher->gender,
            $teacher->department->d_name,
            Carbon::parse($teacher->dob)->diff(\Carbon\Carbon::now())->format('%y years'),
            Carbon::parse($teacher->created_at)->toFormattedDateString(),
        ];
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Email',
            'Phone Number',
            'Address',
            'Dob',
            'Gender',
            'Department ',
            'Age',
            'created_at'
        ];
    }
}
