<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\APIController;

class LoginController extends APIController
{

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return $this->responseUnauthorized([]);
        }

        if(auth()->user()->status != '1') {
            Auth::logout();
            return $this->responseNotAllowed();
        }

        // Get the user data.
        $user = auth()->user(); $profile = '';
        if($user->userInfo) {
            if($user->userInfo->profile) {
                $profile = $user->userInfo->profile;
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Authorized.',
            'token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60,
        ], 200);
    }
}
