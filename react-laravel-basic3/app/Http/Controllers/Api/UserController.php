<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    //
    public function info() {
    	$data['user'] = null;
    	if(Auth::check()) {
    		$data['user'] = Auth::user();
    	}

    	return response()->json($data);
    }
}
