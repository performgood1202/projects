<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isAdmin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $managers = User::where("role","2")->get();
       // echo "<pre>"; print_r($managers); die;
        return view('admin.manager.index',compact("managers"));
    }
    /* add manager */
    public function addManager()
    {
        return view('admin.manager.add');
    }
    /* add manager */
    public function editManager($id)
    {
        $manager = User::where("role","2")->where("id",$id)->first();
        return view('admin.manager.edit',compact("manager","id"));
    }
    /* delete manager */
    public function deleteManager($id)
    {
        $user = User::where( "id", $id )->where("role","2");
        $user->delete();
        return redirect()->back()->with('message', 'Successfully delete!');
    }

    /* post add manager */
    public function postAddManager(Request $request)
    {

        $validator =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'role' => "2",
        ]);

        return redirect()->back()->with('message', 'Successfully register!');
    }

    /* post add manager */
    public function updateManager(Request $request,$id)
    {

        $validator =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::find($id);

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
