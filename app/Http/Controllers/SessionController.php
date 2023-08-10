<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:200'],
            'password' => ['required', 'string', 'max:16', 'min:8'],
        ]);

      if(is_numeric($request->username))
       {

        $login_credentials = [
            'phone'     => $request->username,
            'password'  => $request->password
                ];
       }
    else
       {
            $login_credentials = [
            'email'     => $request->username,
            'password'  => $request->password
                ];
       }
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
          return back()->withErrors(['password' => 'Please Enter Valid User id And Password']);
          }
    }
    public function logout()
    {
        Auth::logout();
        session()->flash('logout','logout Successfully....');
        return redirect()->route('login');
    }
}
