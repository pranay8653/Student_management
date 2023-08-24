<?php

namespace App\Http\Controllers;

use App\Exports\ExportTeacher;
use App\Mail\AdminModifyTeacherMail;
use App\Mail\RegisterMail;
use App\Models\Department;
use App\Models\Studynote;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\str;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

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
            ->orwhere('gender','LIKE', "%$search%")->orderBy('created_at', 'DESC')->paginate(5);
        }
        else
        {
            $teacher = Teacher::with('department')->orderBy('created_at', 'DESC')->paginate(4);
        }
        $count =  Teacher::count();
        $dept = Department::get();
        $dept_count = Department::count();
        return view('teacher.show_teacher',compact('teacher','count','dept','dept_count'));
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

    public function perticular_list(Request $request,$id)
     {
        $department = Department::find($id);
         $search = $request['search'] ?? "";
        if($search != ""   )
        {
            $teacher = Teacher::where('first_name','LIKE', "%$search%")
            ->orwhere('last_name','LIKE', "%$search%")
            ->orwhere('email','LIKE', "%$search%")
            ->orwhere('phone','LIKE', "%$search%")
            ->orwhere('address','LIKE', "%$search%")
            ->orwhere('dob','LIKE', "%$search%")
            ->orwhere('gender','LIKE', "%$search%")->orderBy('created_at', 'DESC')->paginate(5);
        }
        else
        {
        $teacher = $department->teachers()->orderBy('created_at', 'DESC')->paginate(4);
        }
        $teacher_count = $department->teachers()->count();
        return view('teacher.perticular_list',compact('department','teacher','teacher_count'));
     }

    public function perticular_list_pdf(Request $request, $id)
     {
        $department = Department::find($id);
        $teacher = $department->teachers()->get();
        $count = $department->teachers()->count();
        $pdf = PDF::loadView('teacher.perticular_list_pdf',compact('teacher','count','department'));
        return $pdf->download('teacher.pdf');
     }

    public function teacher_profile()
    {
        $profile = Auth::user();
        $name = Auth::user()->first_name;
        $teacher_data = teacher::where('first_name',$name)->first();
        return view('teacher.profile', compact('profile','teacher_data'));
    }

    public function teacher_profile_picture(Request $request)
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
            $file_path = 'upload/teacher/profile_picture';

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

    public function teacher_profile_edit()
    {
        $name = Auth::user()->first_name;
        $teacher_data = teacher::where('first_name',$name)->first();
        return view('teacher.profile_edit', compact('teacher_data'));
    }

    public function teacher_profile_update(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'last_name'  => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'address'    => ['required','regex:/^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/'],
            'dob'        => ['required'],
            'gender'     => ['required'],
        ],
        [
            'first_name'        => 'Please Enter First Name Within 50 Character',
            'last_name'         =>  'Please Enter Last Name Name Within 50 Character',
            'address'           =>  'Please Enter Address within 3-300 But not Used ~!@#$%^ character',
            'dob'               =>  'Please Enter Date Of Birth ',
            'gender'            =>  'Please Enter Gender',
        ]);

        $auth_id = Auth::id();
        $a_email = Auth::user()->email;
        $admin_id = teacher::where('email',$a_email)->first()->id;

        // Update users Table
        $user = User::find($auth_id)->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
        ]);

        // Update admins table
        $admin = teacher::find($admin_id)->update([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'address'       => $data['address'],
            'dob'           => $data['dob'],
            'gender'        => $data['gender'],
        ]);

        return redirect()->route('teacher.profile')->with('admin_profile_update', 'Profile Update Successfully....');
    }

    public function change_password()
    {
      return view('teacher.change_password');
    }

    public function teacher_save_change_password(Request $request)
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
        return redirect()->route('teacher.dashboard')->with('change_password','Your Password Has Changed. Please Logout Your Site And Continue Your Work');
    }

    public function create_note()
     {
        return view('teacher.create_notes');
     }

    public function save_note(Request $request)
    {
        $data = $request->validate([
            'studynote_title'   => ['required'],
            'studynote'         => ['required'],
        ]);

        $a_email = Auth::user()->email;
        $admin = teacher::where('email',$a_email)->first();
        Studynote::create([
            'studynote_title'  => $data['studynote_title'],
            'studynote'        => $data['studynote'],
            'teachers_id'      => $admin->id,
            't_first_name'     => $admin->first_name,
            't_last_name'      => $admin->last_name,
            'department_id'    => $admin->department_id,
        ]);
        return redirect()->route('show.notes')->with('create_notes','Note Created Successfully.....!');
    }

    public function show_note()
    {
       $a_email = Auth::user()->email;
       $admin = teacher::where('email',$a_email)->first();
       $notes = Studynote::where('department_id',$admin->department_id)->orderBy('created_at', 'DESC')->paginate(4);
       $notes_count = Studynote::where('department_id',$admin->department_id)->count();
       $department = Department::find($admin->department_id);
       return view('teacher.show_notes',compact('notes','notes_count','department'));
    }

    public function load_more($id)
     {
        $notes = Studynote::find($id);
        return view('teacher.load_view_notes',compact('notes'));
     }

    public function edit_note($id)
     {
        $notes = Studynote::find($id);
        return view('teacher.edit_notes',compact('notes'));
     }
    public function update_note(Request $request,$id)
     {
        $notes = Studynote::find($id);
        $notes->update([
            'studynote_title'  => $request['studynote_title'],
            'studynote'        => $request['studynote'],
        ]);
        return redirect()->route('load.notes',$request->id)->with('note_update','Notes Edited Successfully....!');
     }

    public function delete_notes($id)
     {
        $notes = Studynote::find($id);
        $notes->delete();
        return redirect()->back()->with('delete_note','Note Deleted Successfully...!');
     }
}
