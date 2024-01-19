<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the Profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        if(Auth::user()->role == "1"){

           return view('admin.profile');

        }else if(Auth::user()->role == "2"){
           return view('manager.profile');
        }else{

        }
    }  

    /* Update Profile*/  

    public function updateProfile(Request $request)
    {
        $validator =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.Auth::user()->id
        ]);

        $user = Auth::user();

        $user->name = $request['name'];
        $user->email = $request['email'];

        


        if(isset($request["password"]) && $request["password"] != ""){

            $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user->password = Hash::make($request['password']);

        }

        $user->save();

        return redirect()->back()->with('message', 'Successfully update!');
    }    

        
}
