<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function login(Request $request)
    {
      $data = $request->validate([
          'email'         => ['required', 'string'],
          'password'      => ['required', 'string' ],
      ],[
          'email'            => 'Please Enter Valid Email id!',
          'password.required'         => 'Please Enter Password!',
      ]);
      $login_credentials = [
          'email'     => $request->email,
          'password'  => $request->password
              ];
    //   dd($login_credentials);
          if(Auth::attempt( $login_credentials ))
          {
              if(Auth::user()->role == 'admin')
               {
                  session()->flash('after_login','login Successfully....');
                   return redirect()->route('admin.dashboard');
               }

          }
          else
          {
          return back()->withErrors(['password' => 'You Entered Wrong password']);
          }
    }
    public function logout()
    {
        Auth::logout();
        session()->flash('logout','logout Successfully....');
        return redirect()->route('login');
    }
}
