<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\TechnicianManagers;
use Illuminate\Support\Facades\Hash;

class TechniciansController extends Controller
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
        $technicians = User::where("role","3")->with("assignManagers")->orderBy("id","desc")->get();

        return view('admin.technician.index',compact("technicians"));
    }
    /* add technician */
    public function addTechnician()
    {
        return view('admin.technician.add');
    }
    /* add technician */
    public function editTechnician($id)
    {
        $technician = User::where("role","3")->where("id",$id)->first();
        return view('admin.technician.edit',compact("technician","id"));
    }
    /* delete technician */
    public function deleteTechnician($id)
    {
        $user = User::where( "id", $id )->where("role","3");
        $user->delete();
        return redirect()->back()->with('message', 'Successfully delete!');
    }


    /* post add technician */
    public function postAddTechnician(Request $request)
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
        ]);

        return redirect()->back()->with('message', 'Successfully register!');
    }

    /* post add technician */
    public function updateTechnician(Request $request,$id)
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

    /* Assign manager */
    public function assignManager($id)
    {
        $managers = User::where("role","2")->get();
        $TechnicianManagers = TechnicianManagers::where("technician_id",$id)->pluck('manager_id')->toArray();
        return view('admin.technician.assignManager',compact("managers","TechnicianManagers","id"));
    }

    /* Post Assign manager */
    public function postAssignManager(Request $request, $id)
    {
        $TechnicianManagers = new TechnicianManagers;
        $TechnicianManagers->where("technician_id",$id)->delete();

        if(isset($request->users)){
            foreach ($request->users as $key => $manager) {
                $TechnicianManagers = new TechnicianManagers;
                $TechnicianManagers->technician_id = $id;
                $TechnicianManagers->manager_id = $manager;
                $TechnicianManagers->save();
            }
        }
        return redirect("admin/technicians")->with('message', 'Successfully assigned!');
    }
}
