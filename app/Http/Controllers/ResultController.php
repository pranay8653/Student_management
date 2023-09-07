<?php

namespace App\Http\Controllers;

use App\Exports\ParticularListStudentExport;
use App\Exports\PerticularDepartmentStudentResult;
use App\Exports\StudentResultExport;
use App\Models\Result;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ResultController extends Controller
{
    public function create_result(Request $request)
    {
        $student = Student::get();
        $search = $request['search'] ?? "";
        if($search != "")
        {
            $result = Result::with('department_name')->with('student')->orderBy('created_at', 'DESC')
                ->whereHas('department_name', function ($query) use ($search){
                $query->where('d_name','LIKE', "%$search%");
            })->orwhereHas('student', function ($query) use ($search){ $query
                ->where('first_name','LIKE', "%$search%")->orwhere('last_name','LIKE', "%$search%");})->paginate(5);
        }
        else
        {
            $result = Result::with('department_name')->orderBy('created_at', 'DESC')->paginate(5);
        }
        return view('admin.create_result',compact('student','result'));
    }

    public function getDepartment(Request $request )
    {
        $student_id = $request->post('student_id');
        $dept_id = Student::where('id',$student_id)->get('department_id');
        $html = '<option value="">Select Student Name</option>';
        foreach($dept_id as $list)
         {
            $html  ='<option value="'.$list->department->id.'">'.$list->department->d_name.'</option>';
         }
        echo $html;
    }

    public function save_result(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'student_id'  => 'required',
            'dept_id'     => 'required',
            'sub_1'       => 'required',
            'sub_2'       => 'required',
            'sub_3'       => 'required',
            'sub_4'       => 'required',
            'sub_5'       => 'required',
            'sub_6'       => 'required',
            'sub_7'       => 'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'    =>400,
                'errors'    =>$validator->messages(),
            ]);
        }
        else
        {
            // count total marks
            $total_number = $request['sub_1'] + $request['sub_2'] + $request['sub_3'] + $request['sub_4'] +$request['sub_5'] + $request['sub_6'] + $request['sub_7'];

            //count Percentage
            $avg_n = ($total_number / 700)*100;
            $avg_number = round( $avg_n,2); // this function userd only show 2 dighits after . "54.22"

            // Calculate Overall Gread
            if($total_number >= 600)
             {
                $gread = "AA";
             }
            elseif($total_number >=500)
             {
                $gread = "A+";
             }
            elseif($total_number >=400)
             {
                $gread = "A";
             }
            elseif($total_number >=350)
             {
                $gread = "B+";
             }
            elseif($total_number >=300)
             {
                $gread = "B";
             }
            elseif($total_number >=280)
             {
                $gread = "passed";
             }
             else
             {
                $gread = "failed";
             }

            Result::create([
                'student_id'    => $request['student_id'],
                'dept_id'       => $request['dept_id'],
                'sub_1'         => $request['sub_1'],
                'sub_2'         => $request['sub_2'],
                'sub_3'         => $request['sub_3'],
                'sub_4'         => $request['sub_4'],
                'sub_5'         => $request['sub_5'],
                'sub_6'         => $request['sub_6'],
                'sub_7'         => $request['sub_7'],
                'total'         =>  $total_number,
                'percentage'    =>  $avg_number,
                'grade'         => $gread,
            ]);
        }

        return response()->json([
            'status'    =>200,
            'message'   => 'Result Added Succesfully',
        ]);
    }

    public function export_result()
    {
        return Excel::download(new StudentResultExport, 'Result.xlsx');
    }
    // teacher show result
    public function show_result()
    {
        $a_email = Auth::user()->email;
        $teacher = Teacher::where('email',$a_email)->first();
        $result = Result::with('department_name')->where('dept_id',$teacher->department_id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('teacher.show_result',compact('result'));
    }

    // teacher show result
    public function show_result_student()
    {
        $a_email = Auth::user()->email;
        $teacher = Student::where('email',$a_email)->first();
        $result = Result::with('department_name')->where('dept_id',$teacher->department_id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('student.show_result',compact('result'));
    }

    public function export_result_perticular_department()
    {
        return Excel::download(new PerticularDepartmentStudentResult(), 'Result.xlsx');
    }


}
