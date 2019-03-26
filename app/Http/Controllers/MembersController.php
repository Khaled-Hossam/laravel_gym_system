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
        $member->date_of_birth = $request->date_of_birth;
        $member->gender = $request->gender;
        $member->password = bcrypt($request->password);
        $member->save($request->all());
        $token = auth('api')->login($member);

        return response()->json([
            'success' => true,
            'message' => 'Member created successfully',
            'token' =>$token,
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


    public function member(Request $request)
    {
        return response()->json([
            'member' => auth('api')->user(),
            ]);
    }

    public function update(Request $request)
    {
        $member = auth('api')->user();
        $member->name= $request->name;
        $member->date_of_birth = $request->date_of_birth;
        $member->gender= $request->gender;
        $member->save();
        return response()->json(['member'=>$member]);
    }
    public function test(Request $request)
    {
        dd($request->all());
    }
    private function valid(){
        
    }
}
