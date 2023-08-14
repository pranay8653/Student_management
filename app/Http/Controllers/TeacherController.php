<?php

namespace App\Http\Controllers;

use App\Exports\ExportTeacher;
use App\Mail\AdminModifyTeacherMail;
use App\Mail\RegisterMail;
use App\Models\Department;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\str;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class TeacherController extends Controller
{
    public function teacher()
     {
        $dept = Department::select('id','d_name')->get();
        return view('teacher.register',compact('dept'));
     }

     public function teacher_save_data(Request $request)
     {
         $data = $request->validate([
             'first_name'       => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
             'last_name'        => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
             'email'            => ['required','string', 'email', 'max:200', 'unique:users,email','regex:/^[a-zA-Z0-9+_.-]+@[a-z]+\.[a-z]{2,4}$/'],
             'phone'            => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
             'address'          => ['required','regex:/^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/'],
             'dob'              => ['required'],
             'gender'           => ['required'],
             'department_id'    => ['required','exists:departments,id' ]
         ],
     [
         'first_name'        => 'Please Enter First Name Within 50 Character',
         'last_name'         =>  'Please Enter Last Name Name Within 50 Character',
         'phone'             =>  'Please Enter 10 Digits Valid Phone number',
         'address'           =>  'Please Enter Address within 3-300 But not Used ~!@#$%^ character',
         'dob'               =>  'Please Enter Date Of Birth ',
         'gender'            =>  'Please Enter Gender',
     ]);
      // create a random password
      $password = Str::random(10);

      // create data teachers table
    $user = Teacher::create([
        'first_name'        =>$request['first_name'],
        'last_name'         =>$request['last_name'],
        'email'             =>$request['email'],
        'phone'             =>$request['phone'],
        'address'           =>$request['address'],
        'dob'               =>$request['dob'],
        'gender'            =>$request['gender'],
        'department_id'     =>$request['department_id'],
    ]);

    // create data User table
    $user = User::create([
        'first_name'        =>$request['first_name'],
        'last_name'         =>$request['last_name'],
        'email'             =>$request['email'],
        'phone'             =>$request['phone'],
        'password'          => Hash::make($password),
        'role'              => 'teacher',
    ]);
    // Send Department name via Email
    $dept_name = Department::where('id',$request['department_id'])->first()->d_name;

    Mail::to($data['email'])->send(new RegisterMail($user,$password,$dept_name));
    return redirect()->route('show.teacher')->with('teacher_registration','Registration Successful. Password & Others Details Are send In Your Registered Email Id');
    }

    public function show_teacher(Request $request)
     {
        $search = $request['search'] ?? "";
        if($search != ""   )
        {
            $teacher = Teacher::where('first_name','LIKE', "%$search%")
            ->orwhere('last_name','LIKE', "%$search%")
            ->orwhere('email','LIKE', "%$search%")
            ->orwhere('phone','LIKE', "%$search%")
            ->orwhere('address','LIKE', "%$search%")
            ->orwhere('dob','LIKE', "%$search%")
            ->orwhere('gender','LIKE', "%$search%")->paginate(5);
        }
        else
        {
            $teacher = Teacher::with('department')->paginate(4);
        }
        $count =  Teacher::count();
        // $dept = Department::select('id','d_name')->get();
        return view('teacher.show_teacher',compact('teacher','count'));
     }

    public function edit_teacher($id)
     {
        $teacher = Teacher::with('department')->find($id);
        $dept = Department::select('id','d_name')->get();
        return view('teacher.teacher_edit',compact('teacher','dept'));
     }

    public function update_teacher(Request $request, $id)
     {
        $data = $request->validate([
            'first_name'       => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'last_name'        => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'email'            => ['required','string', 'email', 'max:200', 'regex:/^[a-zA-Z0-9+_.-]+@[a-z]+\.[a-z]{2,4}$/'],
            'phone'            => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
            'address'          => ['required','regex:/^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/'],
            'dob'              => ['required'],
            'gender'           => ['required'],
            'department_id'    => ['required','exists:departments,id' ]
        ],
        [
            'first_name'        => 'Please Enter First Name Within 50 Character',
            'last_name'         =>  'Please Enter Last Name Name Within 50 Character',
            'phone'             =>  'Please Enter 10 Digits Valid Phone number',
            'address'           =>  'Please Enter Address within 3-300 But not Used ~!@#$%^ character',
            'dob'               =>  'Please Enter Date Of Birth ',
            'gender'            =>  'Please Enter Gender',
        ]);

        $teacher_id = Teacher::find($id);
        $email = Teacher::find($id)->email;
        $t_user_id = User::where('email',$email)->first()->id;

        // Update teachers table
        $teacher_id->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'address'       => $data['address'],
            'dob'           => $data['dob'],
            'gender'        => $data['gender'],
            'department_id' => $data['department_id'],
        ]);

        // Update users Table
        $user = User::find($t_user_id)->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
        ]);

        // Below code are Find Department Name
        $dep_id = Teacher::find($id)->department_id;
        $dept_name = Department::where('id',$dep_id)->first()->d_name;

        Mail::to($data['email'])->send(new AdminModifyTeacherMail($teacher_id,$dept_name));
        return redirect()->route('show.teacher')->with('teacher_update', 'Teacher Account Updated Successfully And Details Are Send Registered Email Account');
     }

     public function teacher_delete($id)
     {
        // First Deleted users table data
        $data = Teacher::find($id)->email;
        $user = User::where('email', $data)->first()->delete();

        // Before deleted users data.Then delete teacher table
        $t_id = Teacher::find($id);
        $t_id->delete();
        return redirect()->route('show.teacher')->with('teacher_delete', 'Deleted Teacher Successfully......');
     }

     public function export_teacher()
      {
        return Excel::download(new ExportTeacher, 'Teacher.xlsx');
      }

    public function teacher_list_pdf()
     {
        $teacher = Teacher::with('department')->get();
        $count =  Teacher::count();
        $pdf = PDF::loadView('teacher.teacherpdf',compact('teacher','count'));
        return $pdf->download('teacher.pdf');
     }
}
