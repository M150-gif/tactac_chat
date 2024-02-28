<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\message;
class pages extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view("login");
    }
    /**
     * Show the form for creating a new resource.
     */
    public function inscription()
    {
        return view("inscription");
    }
    public function chat(Request $request)
    {
        // let get_user_infor
        $other_user_id=$request->user_id_chat;
        $other_user=User::where('id',$other_user_id)->first();
        // let get all message
        $user_id=auth()->user()->id;
        $messages = DB::table('messages')
        ->select('messages.*','users.image')
        ->leftJoin('users', 'users.id', '=', 'messages.user_outgoing_id')
        ->where(function($query) use ($other_user_id, $user_id) {
            $query->where('messages.user_incoming_id', $other_user_id)
                  ->orWhere('messages.user_outgoing_id', $other_user_id);
        })
        ->where(function($query) use ($other_user_id, $user_id) {
            $query->where('messages.user_incoming_id', $user_id)
                  ->orWhere('messages.user_outgoing_id', $user_id);
        })
        ->groupBy('messages.id','messages.message','messages.user_incoming_id','messages.user_outgoing_id','messages.created_at','messages.updated_at','users.image')
        ->get();
        return view("chat",compact("other_user","messages"));
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function user()
    {   
        $user_auth=auth()->user();
        $users=User::where("id",'!=',$user_auth->id)->get();
        $user_id=$user_auth->id;
        foreach($users as $user){
            $other_user_id=$user->id;
            $message = message::where(function($query) use ($user_id, $other_user_id) {
                $query->where('user_incoming_id', $user_id)
                      ->where('user_outgoing_id', $other_user_id);
            })
            ->orWhere(function($query) use ($user_id, $other_user_id) {
                $query->where('user_incoming_id', $other_user_id)
                      ->where('user_outgoing_id', $user_id);
            })
            ->orderBy('id', 'DESC')
            ->first();
            if($message){
                if($message->user_outgoing_id==$user_id){
                    $user->last_message=(strlen($message->message)>28)?substr($message->message,0,28)."....":$message->message;
                    $user->statu="you :";
                }else{
                    $user->statu="";
                    $user->last_message=(strlen($message->message)>28)?substr($message->message,0,28)."....":$message->message;
                }
            }else{
                $user->last_message="No message avaible";
            }
        }
        return view("user",compact("users"));
    }

    /**
     * Display the specified resource.
     */
    public function last_message()
    {
        // $user=auth()->user();
        // $users=User::where("id",'!=',$user_auth->id)->get();
        // foreach ($users as $user) {
            
        // }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
