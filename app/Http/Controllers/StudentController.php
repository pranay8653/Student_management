<?php

namespace App\Http\Controllers;

use App\Exports\ParticularListStudentExport;
use App\Exports\StudentExport;
use App\Mail\RegisterMail;
use App\Mail\StudentModifyMail;
use App\Models\Department;
use App\Models\Student;
use App\Models\Studynote;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\str;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
            'marks_10th'       => ['required'],
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
        'marks_10th'        =>  'Please Enter 10th Class Obtained Marks',
        'hs_marks'          =>  'Please Enter 12th Class Obtained Marks',
    ]);
    $percentage_10th = ($request['marks_10th'] / 700) * 100;
    $percentage_hs = ($request['hs_marks'] / 500) * 100;
     // create a random password
     $password = Str::random(10);

     // create data teachers table
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
        'marks_10th'        =>$request['marks_10th'],
        'hs_marks'          =>$request['hs_marks'],
        'percentage_10th'   =>$percentage_10th,
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
    return redirect()->route('show.student')->with('teacher_registration','Registration Successful. Password & Others Details Are send In Your Registered Email Id');
     }

    public function show_student(Request $request)
    {
    $search = $request['search'] ?? "";
    if($search != ""   )
    {
        $student = Student::where('first_name','LIKE', "%$search%")
        ->orwhere('last_name','LIKE', "%$search%")
        ->orwhere('last_name','LIKE', "%$search%")
        ->orwhere('guardian_name','LIKE', "%$search%")
        ->orwhere('email','LIKE', "%$search%")
        ->orwhere('phone','LIKE', "%$search%")
        ->orwhere('guardian_number','LIKE', "%$search%")
        ->orwhere('address','LIKE', "%$search%")
        ->orwhere('dob','LIKE', "%$search%")
        ->orwhere('gender','LIKE', "%$search%")->orderBy('created_at', 'DESC')->paginate(4);
    }
    else
    {
        $student = Student::with('department')->orderBy('created_at', 'DESC')->paginate(4);
    }
    $count =  Student::count();
    $dept = Department::get();
    $dept_count = Department::count();
    return view('student.show_student',compact('student','count','dept','dept_count'));
    }

    public function perticular_list(Request $request,$id)
     {
        $department = Department::find($id);
         $search = $request['search'] ?? "";
        if($search != ""   )
        {
            $student = Student::where('first_name','LIKE', "%$search%")
            ->orwhere('last_name','LIKE', "%$search%")
            ->orwhere('last_name','LIKE', "%$search%")
            ->orwhere('guardian_name','LIKE', "%$search%")
            ->orwhere('email','LIKE', "%$search%")
            ->orwhere('phone','LIKE', "%$search%")
            ->orwhere('guardian_number','LIKE', "%$search%")
            ->orwhere('address','LIKE', "%$search%")
            ->orwhere('dob','LIKE', "%$search%")
            ->orwhere('gender','LIKE', "%$search%")->orderBy('created_at', 'DESC')->paginate(5);
        }
        else
        {
        $student = $department->students()->orderBy('created_at', 'DESC')->paginate(4);
        }
        $student_count = $department->students()->count();
        return view('student.perticular_list',compact('department','student','student_count'));
     }

    public function edit_student($id)
    {
    $student = Student::with('department')->find($id);
    $dept = Department::select('id','d_name')->get();
    return view('student.student_edit',compact('student','dept'));
    }

    public function update_student(Request $request, $id)
     {
        $data = $request->validate([
            'first_name'       => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'last_name'        => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'guardian_name'    => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'email'            => ['required','string', 'email', 'max:200', 'regex:/^[a-zA-Z0-9+_.-]+@[a-z]+\.[a-z]{2,4}$/'],
            'phone'            => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
            'guardian_number'  => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
            'address'          => ['required','regex:/^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/'],
            'dob'              => ['required'],
            'gender'           => ['required'],
            'department_id'    => ['required','exists:departments,id' ],
            'marks_10th'       => ['required'],
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
            'marks_10th'        =>  'Please Enter 10th Class Obtained Marks',
            'hs_marks'          =>  'Please Enter 12th Class Obtained Marks',
        ]);

        $percentage_10th = ($request['marks_10th'] / 700) * 100;
        $percentage_hs = ($request['hs_marks'] / 500) * 100;

        $student_id = Student::find($id);
        $email = Student::find($id)->email;
        $s_user_id = User::where('email',$email)->first()->id;

        // Update teachers table
        $student_id->update([
            'first_name'        =>$data['first_name'],
            'last_name'         =>$data['last_name'],
            'guardian_name'     =>$data['guardian_name'],
            'guardian_number'   =>$data['guardian_number'],
            'email'             =>$data['email'],
            'phone'             =>$data['phone'],
            'address'           =>$data['address'],
            'dob'               =>$data['dob'],
            'gender'            =>$data['gender'],
            'department_id'     =>$data['department_id'],
            'marks_10th'        =>$data['marks_10th'],
            'hs_marks'          =>$data['hs_marks'],
            'percentage_10th'   =>$percentage_10th,
            'hs_percentage'     =>$percentage_hs,
        ]);

        // Update users Table
        $user = User::find($s_user_id)->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
        ]);

        // Below code are Find Department Name
        $dep_id = Student::find($id)->department_id;
        $dept_name = Department::where('id',$dep_id)->first()->d_name;

        Mail::to($data['email'])->send(new StudentModifyMail($student_id,$dept_name));
        return redirect()->route('show.student')->with('teacher_update', 'Student Account Updated Successfully And Details Are Send Registered Email Account');
     }

    public function student_delete($id)
    {
        // First Deleted users table data
        $data = Student::find($id)->email;
        $user = User::where('email', $data)->first()->delete();

        // Before deleted users data.Then delete teacher table
        $t_id = Student::find($id);
        $t_id->delete();
    return redirect()->route('show.student')->with('teacher_delete', 'Deleted Student Successfully......');
    }

    public function export_student()
    {
        return Excel::download(new StudentExport, 'Student.xlsx');
    }

    public function student_list_pdf()
    {
        $student = Student::with('department')->get();
        $count =  Student::count();
        $pdf = PDF::loadView('student.studentpdf',compact('student','count'));
        return $pdf->download('Student.pdf');
    }

    public function export_particular_department_excel($id)
    {
        return Excel::download(new ParticularListStudentExport($id), 'Particular_dept_allStudent.xlsx' );
    }

    public function student_profile()
    {
        $profile = Auth::user();
        $name = Auth::user()->first_name;
        $student_data = Student::where('first_name',$name)->first();
        return view('student.profile', compact('profile','student_data'));
    }

    public function student_profile_picture(Request $request)
    {
        $id = Auth::user()->id;
        $post = User::find($id);
        $data = $request->validate([
            'image' => ['required', 'mimes:jpeg,png,jpg,gif,svg' ]
        ]);

        if($post)
       {

         if($request->hasfile('image'))
          {
            $file_path = 'upload/student/profile_picture';

            if(File::exists(public_path($file_path . '/' . $post->image)))
               {
                 File::delete(public_path($file_path . '/' . $post->image));
               }

               $file_name = Carbon::now()->timestamp;
               $file_extension = $request['image']->getClientOriginalExtension();
               $request['image']->move($file_path, $file_name.'.'.$file_extension);
               $data['image'] = $file_name.'.'.$file_extension;

               $post->update([
                'image' => $file_name.'.'.$file_extension,
               ]);
          }

       }
        return redirect()->back()->with('admin_picture','Profile Picture updated Successfully');
    }

    public function student_profile_edit()
    {
        $name = Auth::user()->first_name;
        $student_data = student::where('first_name',$name)->first();
        return view('student.profile_edit', compact('student_data'));
    }

    public function student_profile_update(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'last_name'  => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'address'    => ['required','regex:/^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/'],
            'guardian_name'    => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'guardian_number'  => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
            'dob'        => ['required'],
            'gender'     => ['required'],
        ],
        [
            'first_name'        => 'Please Enter First Name Within 50 Character',
            'last_name'         =>  'Please Enter Last Name Name Within 50 Character',
            'guardian_name'     =>  'Please Enter Guardian Name Within 50 Character',
            'guardian_number'   =>  'Please Enter 10 Digits Valid Guardian Phone number',
            'address'           =>  'Please Enter Address within 3-300 But not Used ~!@#$%^ character',
            'dob'               =>  'Please Enter Date Of Birth ',
            'gender'            =>  'Please Enter Gender',
        ]);

        $auth_id = Auth::id();
        $a_email = Auth::user()->email;
        $student_id = Student::where('email',$a_email)->first()->id;

        // Update users Table
        $user = User::find($auth_id)->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
        ]);

        // Update students table
        $admin = Student::find($student_id)->update([
            'first_name'     => $data['first_name'],
            'last_name'      => $data['last_name'],
            'guardian_name'  =>$data['guardian_name'],
            'guardian_number'=>$data['guardian_number'],
            'address'        => $data['address'],
            'dob'            => $data['dob'],
            'gender'         => $data['gender'],
        ]);

        return redirect()->route('student.profile')->with('admin_profile_update', 'Profile Update Successfully....');
    }

    public function change_password()
    {
      return view('student.change_password');
    }

    public function student_save_change_password(Request $request)
    {
        $data = $request->validate([
            'current_password'       => ['required', 'string'],
            'new_password'           => ['required', 'string', 'max:16', 'min:8', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
        ]);

        $user = User::find(Auth::id());
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors('Current password does not match!');
        }

        $user->update([
            'password' => Hash::make($request->new_password_confirmation)
        ]);
        // session()->flash('new_password','The password is changed....');
        return redirect()->route('student.dashboard')->with('change_password','Your Password Has Changed. Please Logout Your Site And Continue Your Work');
    }

    public function show_note()
    {
       $a_email = Auth::user()->email;
       $student = Student::where('email',$a_email)->first();
       $notes = Studynote::where('department_id',$student->department_id)->orderBy('created_at', 'DESC')->paginate(4);
       $notes_count = Studynote::where('department_id',$student->department_id)->count();
       $department = Department::find($student->department_id);
       return view('student.show_notes',compact('notes','notes_count','department'));
    }

    public function load_more($id)
     {
        $notes = Studynote::find($id);
        return view('student.load_view_notes',compact('notes'));
     }

    public function perticular_note_pdf($id)
    {
        $notes = Studynote::with('department')->find($id);
        $pdf = PDF::loadView('student.study_note_pdf',compact('notes'));
        return $pdf->download('Study_note.pdf');
    }
}
