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
        $member = Member::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'date_of_birth' => $request->date_of_birth,
            'gender'=> $request->gender,
            ]);
            
        $token = auth('api')->login($member);

        return response()->json([
            'success' => true,
            'message' => 'Member created successfully',
            'token' => $token,
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
                    'Username or password is incorrect'
                ]
            ], 401);

        return response()->json([
            'success' => true,
            'messagee' => 'Member logged in',
            'data ' => [
                'user' => $request->all(),
                'token' => $token,
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        auth('api')->logout(true);

        return response()->json([
            'success' => true,
            'message' => 'Member logged out'
        ], 200);
    }


    public function member(Request $request)
    {
        return response()->json([
            'member' => auth('api')->user(),
        ]);
    }

    public function update(Request $request)
    {
        $member = auth('api')->user();
        $member->name = $request->name;
        $member->date_of_birth = $request->date_of_birth;
        $member->gender = $request->gender;
        $member->save();
        return response()->json(['member' => $member]);
    }
    public function test(Request $request)
    {
        dd($request->all());
    }
}
