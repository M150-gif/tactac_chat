<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class authentification extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function inscription(Request $request)
    {
        $validate=$request->validate([
            "fname"=>"required|string|max:255",
            "lname"=>"required|string|max:255",
            "email"=>"required|email|unique:users,email|max:255",
            "password"=>"required|string|min:12|max:255",
            "image"=>"required|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);
        if($validate){
            $path = $request->file('image')->store('images',"public");
            $pathImage="http://localhost:8000/storage/".$path;
            $user=User::create(["fname"=>$request->fname
            ,"lname"=>$request->lname
            ,"fname"=>$request->fname
            ,"password"=>Hash::make($request->password)
            ,"email"=>$request->email
            ,"status"=>"active now"
            ,"image"=>$pathImage]);
            $credentiuls=["email"=>$request->email,"password"=>$request->password];
            if(auth::attempt($credentiuls)){
                $request->session()->regenerate();
                 return redirect()->route('user');
             }else{
                 return back()->withErrors([
                     'email' => 'Les informations de connexion fournies sont incorrectes.',
                 ]);
             }
        }else{
            return back()->withErrors([
                'email' => 'Les informations de connexion fournies sont incorrectes.',
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
            $validate=$request->validate([
                "email"=>"required|max:255",
                "password"=>"required|min:12|max:64",
            ]);
                if(auth::attempt($validate)){
                    auth()->user()->update(["status"=>"active now"]);
                   $session=$request->session()->regenerate();
                    return redirect()->route('user');
                
                }else{
                    return back()->withErrors([
                        'email' => 'Les informations de connexion fournies sont incorrectes.',
                    ]);
                }
    }
    /**
     * Display the specified resource.
     */
    public function logout(){
        $user_auth=auth()->user();
        $user_auth->update(["status"=>"offline now"]);
        Session::flush();
        Auth::logout();
        return redirect()->route('login')->with('success_logout','vous avez deconecte');
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
