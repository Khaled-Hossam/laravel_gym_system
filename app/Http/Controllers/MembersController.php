<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemberRegisterRequest;
use App\Member;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class MembersController extends Controller

{
    public function register(MemberRegisterRequest $request)
    {
        $member = new Member();
        $member->name = $request->name;
        $member->email = $request->email;
        $member->password = bcrypt($request->password);
        $member->save();

        return response()->json([
            'success' => true,
            'message' => 'Member created successfully',
            'data' => $request->all()
        ], 201);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $token = auth('api')->attempt($credentials);
        if (!$token)
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'errors' => [
                    'Username or password do not match'
                ]
            ], 401);

        return response()->json([
            'success' => true,
            'messagee' => 'User logged in',
            'data ' => [
                'user' => $request->all(),
                'token' => $token,
            ]
        ], 200);
    }
}
