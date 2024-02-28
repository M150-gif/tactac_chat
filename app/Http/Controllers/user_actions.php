<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\message;

class user_actions extends Controller
{
    public function get_users(){
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
                    $user->last_message=(strlen($message->message)>28)?substr($message->message,0,28)."....":$message->message;
                    $user->statu="";
                }
            }else{
                $user->last_message="No message avaible";
                $user->statu="";
            }
        }
        return response()->json(["message"=>$users]);
    }
    public function send_message(Request $request){
        
       try{
        $message=message::create([
            "user_incoming_id"=>$request->incoming_user_id,
            "user_outgoing_id"=>auth()->user()->id,
            "message"=>$request->message,
        ]);
        return response()->json(["message"=>"message send it!"]);
       }catch(erreur){
        return response()->json(["message"=>"erreur"]);
       }
    }
    public function get_messages(Request $request){
        $user_id=auth()->user()->id;
        $other_user_id=$request->other_user_id;
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
        return response()->json(["messages"=>$messages]);

    }
    public function search_users(Request $request){
        $user_auth=auth()->user();
        $users=User::where("id",'!=',$user_auth->id)->where("fname",'like','%'.$request->users_searching.'%')
        ->orwhere("lname",'like','%'.$request->users_searching.'%')
        ->get();
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
                    $user->last_message=(strlen($message->message)>28)?substr($message->message,0,28)."....":$message->message;
                    $user->statu="";
                }
            }else{
                $user->last_message="No message avaible";
            }
        }
        return response()->json(["message"=>$users]);
    }
}
