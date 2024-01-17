<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Traits\CommonTrait;
use App\Services\User\UserService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    use CommonTrait;
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    // user register
    public function register(UserRequest $request) {
        try {
            $user = $this->userService->createUser($request);
            $this->message = [
                "status" => true,
                "message" => "Register successfully!",
                "data" => $user
            ];
        } catch (\Exception $th) {
            $this->message = [
                "status" => false,
                "message" => "Risegter error: " . $th->getMessage(),
            ];
        }
        return response()->json($this->message);
    }

    // user login
    public function login(LoginRequest $request) {
        $token = JWTAuth::attempt([
            'email' => $request->email, 
            'password' => $request->password
        ]);

        if(! empty($token)) {
            return response()->json([
                'status' => true,
                'message' => "User logged in succcessfully!",
                'token' => $token
            ]);
        }

        return response()->json([
            "status" => false,
            "message" => "Invalid details"
        ]);
    }

    // refresh token value
    public function refreshToken() {
        $newToken = auth()->refresh();
        return response()->json([
            "status" => true,
            "message" => "New access token",
            'token' => $newToken
        ]);
    }

    // user profile
    public function profile() {
        $profile = auth()->user();
        return response()->json([
            "status" => true,
            "message" => "Profile data",
            "data" => $profile
        ]);
    }

    // user logout
    public function logout() {
        auth()->logout();
        return response()->json([
            "status" => true,
            "message" => "User logged out successfully!",
        ]);
    }
}
