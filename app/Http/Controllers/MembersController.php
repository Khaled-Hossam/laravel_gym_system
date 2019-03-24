<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemberRegisterRequest;
use App\Member;

class MembersController extends Controller
{
    public function register(MemberRegisterRequest $request)
    {
        Member::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Member created successfully',
            'data' => $request->all()
        ], 201);
    }
}
