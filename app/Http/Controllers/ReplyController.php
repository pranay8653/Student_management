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
                'message'   => 'Instruction Added Succesfully',
            ]);
        }
    }

    public function showquerry($id)
    {
        $querry = Querry::with('replies')->with('user')->where('studynotes_id', $id)->get();
        $querry_count = Querry::with('user')->where('studynotes_id', $id)->count();
        $reply_count = Reply::where('studynotes_id', $id)->count();
        $count_conversation =  $querry_count + $reply_count;

        return response()->json([
            'querry'=>$querry,
            'count_conversation'=>$count_conversation,
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
                    'message'   => 'Instruction updated Succesfully',
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
            'message'   => 'Your Instruction Deleted Succesfully',
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
                'message'   => 'Reply Added Succesfully',
            ]);
        }
    }

    public function edit_reply($id)
    {
        $reply_id = Reply::find($id);
        if($reply_id)
        {
           return response()->json([
                'status'    =>200,
                'reply_id' => $reply_id,
           ]);
        }
        else
        {
            return response()->json([
                'status'    =>404,
                'message'   => 'Reply Not Found',
           ]);
        }
    }

    public function update_reply(Request $request,$id)
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
            $reply_id = Reply::find($id);
            if($reply_id)
            {
                $reply_id->reply = $request->input('reply');
                $reply_id->update();
                return response()->json([
                    'status'    =>200,
                    'message'   => 'Reply updated Succesfully',
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

    public function delete_reply($id)
    {
        $querry_id = Reply::find($id);
        $querry_id->delete();
        
        return response()->json([
            'status'    =>200,
            'message'   => 'Your Reply Deleted Succesfully',
        ]);
    }
}
