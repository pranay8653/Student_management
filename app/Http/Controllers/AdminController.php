<?php

namespace App\Http\Controllers;

use App\Mail\AdminRegisterMail;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\str;

class AdminController extends Controller
{
    public function index()
     {
        return view('admin.register');
     }

    public function admin_save_data(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'last_name'  => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'email'      => ['required','string', 'email', 'max:200', 'unique:users,email','regex:/^[a-zA-Z0-9+_.-]+@[a-z]+\.[a-z]{2,4}$/'],
            'phone'      => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
            'address'    => ['required','regex:/^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/'],
            'dob'        => ['required'],
            'gender'     => ['required'],
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

    $user = User::create([
        'first_name'        =>$request['first_name'],
        'last_name'         =>$request['last_name'],
        'email'             =>$request['email'],
        'phone'             =>$request['phone'],
        'address'           =>$request['address'],
        'dob'               =>$request['dob'],
        'gender'            =>$request['gender'],
        'password'          => Hash::make($password),
        'role'              => 'admin',
    ]);
    Mail::to($data['email'])->send(new AdminRegisterMail($user,$password));
    return redirect()->route('login')->with('admin_register','Your Password is send in your register Email id');
    }

    public function admin_profile()
    {
        $profile = Auth::user();
        return view('admin.profile', compact('profile'));
    }

    public function admin_profile_picture(Request $request)
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
            $file_path = 'upload/admin/profile_picture';

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

    public function admin_profile_edit()
    {
        $profile = Auth::user();
        return view('admin.profile_edit', compact('profile'));
    }

    public function admin_profile_update(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'last_name'  => ['required','regex:/^[A-Za-z. ]{3,50}$/'],
            'phone'      => ['required', 'integer', 'digits:10', 'regex:/^[0-9]{10}$/'],
            'address'    => ['required','regex:/^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/'],
            'dob'        => ['required'],
            'gender'     => ['required'],
        ],
    [
        'first_name'        => 'Please Enter First Name Within 50 Character',
        'last_name'         =>  'Please Enter Last Name Name Within 50 Character',
        'phone'             =>  'Please Enter 10 Digits Valid Phone number',
        'address'           =>  'Please Enter Address within 3-300 But not Used ~!@#$%^ character',
        'dob'               =>  'Please Enter Date Of Birth ',
        'gender'            =>  'Please Enter Gender',
    ]);
        $admin_profile = User::find(Auth::id())->update($data);
        return redirect()->route('admin.profile')->with('admin_profile_update', 'Profile Update Successfully....');
    }

    public function create_department(Request $request)
     {
        $search = $request['search'] ?? "";

         if($search != "")
          {
            $dept = Department::where('d_name','LIKE', "%$search%")->paginate(5);
          }
        else
          {
            $dept = Department::paginate(5);
          }
        $d_count = Department::count();
        return view('department.department',compact('dept','d_count','search'));
     }

     public function save_department(Request $request)
     {
        $data = $request->validate([
            'd_name' => ['required','string','min:3','max:150','unique:departments,d_name']
        ],[
            'd_name.required' => 'Please Enter a Name',
            'd_name.unique' => 'The name has already been taken. Please Check And Donot enter same data',
        ]);
        Department::create($data);
        return redirect()->route('departments')->with('department','Department Created Succsfully');
     }

    public function edit_department(Request $request, $id)
    {
        $dept = Department::find($id);
        return view('department.department_edit',compact('dept'));
    }

    public function update_department(Request $request, $id)
     {

        $data = $request->validate([
            'd_name' => ['required','string','min:3','max:150','unique:departments']
        ]);
        $dept = Department::find($id)->update($data);
        return redirect()->route('departments')->with('department_edit','Department Edit Successfully....');
     }

    public function department_delete($id)
     {
        $dept = Department::find($id);
        if(!is_null($dept))
         {
            $dept->delete();
         }
        return redirect()->route('departments')->with('delete_department', 'Department Deleted Successfully......');
     }
}
