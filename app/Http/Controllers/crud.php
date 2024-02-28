<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class crud extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function users()
    {
        $users=User::all();
        if($users){
            return response()->json(["status"=>"success","user"=>$users],201);
        }else{
            return response()->json(["status"=>"no user existe"],201);
        }
       
        
        
    }
    public function user($id)
    {
        $user=User::find($id);
        if($user){
            return response()->json(["status"=>"success","user"=>$user],201);
        }else{
            return response()->json(["status"=>"this user not exist"],500);
        }
       
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
