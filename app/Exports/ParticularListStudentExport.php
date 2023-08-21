<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticularListStudentExport implements FromCollection, WithHeadings, WithMapping
{
    protected $id;

        function __construct($id) {
                $this->id = $id;
        }

    /**
     *
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::where('department_id',$this->id)->get();
    }

    public function map($student) : array {
        return [
            $student->first_name,
            $student->last_name,
            $student->guardian_name,
            $student->guardian_number,
            $student->email,
            $student->phone,
            $student->address,
            $student->dob,
            $student->gender,
            $student->department->d_name,
            Carbon::parse($student->dob)->diff(\Carbon\Carbon::now())->format('%y years'),
            $student->marks_10th,
            $student->percentage_10th,
            $student->hs_marks,
            $student->hs_percentage,
            Carbon::parse($student->created_at)->toFormattedDateString(),
        ];
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Guardian Name',
            'Guardian Mobile Number',
            'Email',
            'Phone Number',
            'Address',
            'Dob',
            'Gender',
            'Department ',
            'Age',
            'Marks Of 10th',
            'Percentage Of 10th',
            'Marks Of 12th',
            'Percentage Of 12th',
            'created_at'
        ];
    }
}
