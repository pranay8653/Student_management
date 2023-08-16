<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
     {
        $dept = Department::select('id','d_name')->get();
        return view('student.register',compact('dept'));
     }

     public function student_save_data(Request $request)
     {
        dd($request);
     }
}
