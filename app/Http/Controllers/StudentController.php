<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\str;

class StudentController extends Controller
{
    public function index()
     {
        $dept = Department::select('id','d_name')->get();
        return view('student.register',compact('dept'));
     }

     public function student_save_data(Request $request)
     {
        $data = $request->validate([
            'first_name'       => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'last_name'        => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'guardian_name'    => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'email'            => ['required','string', 'email', 'max:200', 'unique:users,email','regex:/^[a-zA-Z0-9+_.-]+@[a-z]+\.[a-z]{2,4}$/'],
            'phone'            => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
            'guardian_number'  => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
            'address'          => ['required','regex:/^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/'],
            'dob'              => ['required'],
            'gender'           => ['required'],
            'department_id'    => ['required','exists:departments,id' ],
            '10th_marks'       => ['required'],
            'hs_marks'         => ['required'],
        ],
    [
        'first_name'        => 'Please Enter First Name Within 50 Character',
        'last_name'         =>  'Please Enter Last Name Within 50 Character',
        'guardian_name'     =>  'Please Enter Guardian Name Within 50 Character',
        'phone'             =>  'Please Enter 10 Digits Valid Phone number',
        'guardian_number'   =>  'Please Enter 10 Digits Valid Guardian Phone number',
        'address'           =>  'Please Enter Address within 3-300 But not Used ~!@#$%^ character',
        'dob'               =>  'Please Enter Date Of Birth ',
        'gender'            =>  'Please Enter Gender',
        '10th_marks'        =>  'Please Enter 10th Class Obtained Marks',
        'hs_marks'          =>  'Please Enter 12th Class Obtained Marks',
    ]);
    $percentage_10th = ($request['10th_marks'] / 700) * 100;
    $percentage_hs = ($request['hs_marks'] / 500) * 100;

     // create a random password
     $password = Str::random(10);

//      // create data teachers table
    $user = Student::create([
        'first_name'        =>$request['first_name'],
        'last_name'         =>$request['last_name'],
        'guardian_name'     =>$request['guardian_name'],
        'guardian_number'   =>$request['guardian_number'],
        'email'             =>$request['email'],
        'phone'             =>$request['phone'],
        'address'           =>$request['address'],
        'dob'               =>$request['dob'],
        'gender'            =>$request['gender'],
        'department_id'     =>$request['department_id'],
        '10th_marks'        =>$request['10th_marks'],
        'hs_marks'          =>$request['hs_marks'],
        '10th_percentage'   =>$percentage_10th,
        'hs_percentage'     =>$percentage_hs,
    ]);

   // create data User table
    $user = User::create([
        'first_name'        =>$request['first_name'],
        'last_name'         =>$request['last_name'],
        'email'             =>$request['email'],
        'phone'             =>$request['phone'],
        'password'          => Hash::make($password),
        'role'              => 'student',
    ]);
   // Send Department name via Email
    $dept_name = Department::where('id',$request['department_id'])->first()->d_name;

    Mail::to($data['email'])->send(new RegisterMail($user,$password,$dept_name));
    return redirect()->route('show.teacher')->with('teacher_registration','Registration Successful. Password & Others Details Are send In Your Registered Email Id');
     }
}
