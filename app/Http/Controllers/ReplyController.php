<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Querry;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function store_instruction(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'querry'  => 'required',
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
            $auth_user = Auth::user()->email;
            $user = User::where('email',$auth_user)->first();
            Querry::create([
                'querry'    => $request->querry,
                'studynotes_id'    => $request->studynotes_id,
                'user_id'    => $user->id,
                'user_role'    => $user->role,

            ]);

            return response()->json([
                'status'    =>200,
                'message'   => 'Data Added Succesfully',
            ]);
        }
    }
    public function showquerry($id)
    {
        $querry = Querry::with('user')->where('studynotes_id', $id)->get();
        $querry_count = Querry::with('user')->where('studynotes_id', $id)->count();
        return response()->json([
            'querry'=>$querry,
            'querry_count'=>$querry_count,
        ]);
    }

    public function edit_querry($id)
    {
        $querry_id = Querry::find($id);
        if($querry_id)
        {
           return response()->json([
                'status'    =>200,
                'querry_id' => $querry_id,
           ]);
        }
        else
        {
            return response()->json([
                'status'    =>404,
                'message'   => 'Querry Not Found',
           ]);
        }
    }

    public function update_querry(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'querry'  => 'required',
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
            $querry_id = Querry::find($id);
            if($querry_id)
            {
                $querry_id->querry = $request->input('querry');
                $querry_id->update();
                return response()->json([
                    'status'    =>200,
                    'message'   => 'Data updated Succesfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'    =>404,
                    'message'   => 'Data Not Found',
                ]);
            }
        }
    }
    public function delete_querry($id)
    {
        $querry_id = Querry::find($id);
        $querry_id->delete();
        return response()->json([
            'status'    =>200,
            'message'   => 'Your Querry Deleted Succesfully',
        ]);
    }

    public function reply_open($id)
    {
        $querry_id = Querry::find($id);
        if($querry_id)
        {
           return response()->json([
                'status'    =>200,
                'querry_id' => $querry_id,
           ]);
        }
        else
        {
            return response()->json([
                'status'    =>404,
                'message'   => 'Querry Not Found',
           ]);
        }
    }

    public function reply_querry(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'reply'  => 'required',
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
            $auth_user = Auth::user()->email;
            $user = User::where('email',$auth_user)->first();
            Reply::create([
                'user_id'           => $user->id,
                'studynotes_id'     => $request->studynotes_id,
                'querry_id'         => $request->querry_id,
                'user_role'         => $user->role,
                'reply'             => $request->reply,
            ]);

            return response()->json([
                'status'    =>200,
                'message'   => 'Data Added Succesfully',
            ]);
        }
    }
}
