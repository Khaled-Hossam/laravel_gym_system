<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemberRegisterRequest;
use App\Member;
use Mail;
use App\VerificationCode;
use Illuminate\Support\Carbon;



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
        $this->send_verification_email($member);

        return response()->json([
            'success' => true,
            'message' => 'Member created successfully',
            'descritption'=> 'Please follow the email we have sent you to complete your registration',
            'data' => $request->all()
        ], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = auth('api')->attempt($credentials);
        $member = auth('api')->user();
        if (!$token || !$member->verified)
            return response()->json([
                'success' => false,
                'message' => 'Login failed',
                'errors' => [
                    'Username or password is incorrect or maybe your account has not been verified yet'
                ]
            ], 401);
            
        $member->last_login = Carbon::now()->toDateTimeString();
        $member->save();

        return response()->json([
            'success' => true,
            'messagee' => 'Member logged in',
            'data ' => [
                'member' => $member,
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


    // Get the current authorized member
    public function member(Request $request)
    {
        return response()->json([
            'member' => auth('api')->user(),
        ]);
    }

    // Update the current authorized member
    public function update(Request $request)
    {
        $member = auth('api')->user();
        $member->name = $request->name;
        $member->date_of_birth = $request->date_of_birth;
        $member->gender = $request->gender;
        $member->save();
        return response()->json(['member' => $member]);
    }
    protected function send_verification_email($member)
    {
        
        $code = str_random(30);
        VerificationCode::create([
            'code'=> $code,
            'member_id' => $member->id,
            ]);

        $name = $member->name;
        $email = $member->email;
        $subject = "Testing";

        $mail = Mail::send('email.verify', ['name' => $member->name, 'code' => $code],
        function($mail) use ($email, $name, $subject){
            $mail->from(getenv('FROM_EMAIL_ADDRESS'), "laragymvel@gmail.com");
            $mail->to($email, $name);
            $mail->subject($subject);
        });
    }


    public function verify($code)
    {
        if($verification_code = VerificationCode::where('code',$code)->first()){
            $member = $verification_code->member;
            $member->verified=true;
            $member->save();
            $verification_code->delete();
            dd($member);
        }
    }


}
