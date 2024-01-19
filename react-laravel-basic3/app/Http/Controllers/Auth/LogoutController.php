<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\APIController;
use Session;

class LogoutController extends APIController
{

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        Session::flush();
        return $this->responseSuccess('Successfully logged out.');
    }
}
