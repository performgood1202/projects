<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TechnicianManagers;
use Auth;

class ManagerController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('isManager');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $technicians = TechnicianManagers::where("manager_id",Auth::user()->id)->count();
        //echo "<pre>"; print_r($technicians); die;
        return view('manager.dashboard',compact("technicians"));
    }
}
