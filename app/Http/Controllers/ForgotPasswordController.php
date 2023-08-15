<?php

namespace App\Http\Controllers;

use App\Mail\AfterSaveForgotChangePasswordMail;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\str;

class ForgotPasswordController extends Controller
{
    public function forgot()
    {
    return view('forgot_password');
    }

    public function post_forgot(Request $request)
    {
        $data = $request->validate([
            'email'         => ['required', 'string', 'email', 'max:200', 'exists:users'],
        ]);
        $token = Str::random(8);
        $p_reset = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        $user = User::where('email', $data['email'])->first();
        Mail::to($data['email'])->send(new ForgotPasswordMail($user, $token));
        return redirect()->route('reset.password')->with('forgot_otp','The OTP code Send Your Rgistered Email Id');
    }

    public function reset()
    {
        return view('reset_password');
    }

    public function post_reset(Request $request)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'max:16', 'min:8', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
            'token' => ['required', 'string', 'exists:password_resets']
        ]);

        $token = DB::table('password_resets')->where('token', $request['token'])->first();
        if($user=User::where('email',$token->email)->first()){
            $user->password = Hash::make($data['password']);
            $user->save();
            DB::table('password_resets')->where('email',$user->email)->delete();
        }
        /** @var User $user, $email */
        Mail::to($user['email'])->send(new AfterSaveForgotChangePasswordMail($user,$data['password']));
        return redirect()->route('login')->with('new_password','The New password will send Your register email id');
    }
}
