<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemberRegisterRequest;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\AttendSessionRequest;
use App\Member;
use App\Session;
use Mail;
use App\VerificationCode;
use Illuminate\Support\Carbon;
use App\Attendance;
use App\Rules\Test;
use Carbon\CarbonPeriod;
use App\Notifications\GreetNotification;
// update photo 


class MembersController extends Controller
{

    public function register(MemberRegisterRequest $request)
    {
        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
        ]);
        // Storage::disk('public')->url(Auth::user()->avatar);

        if ($request->hasFile('avatar')) {
            $member->avatar = $request->file('avatar')->store('members', 'public');
            $member->save();
        }


        $this->send_verification_email($member);

        return response()->json([
            'success' => true,
            'message' => 'Member created successfully',
            'descritption' => 'Please follow the email we have sent you to complete your registration',
            'data' => $member
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
            'data' => [
                'member' => auth('api')->user(),
                'avatar' => Storage::disk('public')->url(auth('api')->user()->avatar)
            ]
        ]);
    }

    // Update the current authorized member
    public function update(Request $request)
    {
        $member = auth('api')->user();
        $member->name = $request->name;
        $member->date_of_birth = $request->date_of_birth;
        $member->gender = $request->gender;

        if ($request->hasFile('avatar')) {
            Storage::delete('public/'.$member->avatar);
            $member->avatar = $request->file('avatar')->store('members', 'public');
        }

        $member->save();
        return response()->json(['member' => $member]);
    }



    protected function send_verification_email($member)
    {
        // making sure that the random code is unique
        do {
            $code = str_random(30);
        } while (VerificationCode::where('code', $code)->first());

        VerificationCode::create([
            'code' => $code,
            'member_id' => $member->id,
        ]);

        $name = $member->name;
        $email = $member->email;
        $subject = "Laragymvel Membership Verification";

        $mail = Mail::send(
            'email.verify',
            ['name' => $member->name, 'code' => $code],
            function ($mail) use ($email, $name, $subject) {
                $mail->from(getenv('MAIL_USERNAME'));
                $mail->to($email, $name);
                $mail->subject($subject);       
            }
        );
    }


    public function verify($code)
    {
        if ($verification_code = VerificationCode::where('code', $code)->first()) {
            $member = $verification_code->member;
            $member->verified = true;
            $member->save();
            $verification_code->delete();
            $member->notify(new GreetNotification());
            return ('<h1>Glad to see you get verified brothah</h1><p>you can now use POSTMAN for some action </p>');
        }
        return ('<h1>Oops something went wrong </h1>');
    }



    public function attend($session_id)
    {
        // checks to see if session exists
        if (!$session = Session::find($session_id)) {
            return response()->json([
                'success' => false,
                'message' => 'Session not found'
            ], 404);
        }

        // checks to see if the  attending time is in session time
        if( !Carbon::now()->between(
            new Carbon($session->starts_at),
            new Carbon($session->finishes_at)))
            return response()->json([
                'success'=>false,
                'message'=> 'Sorry you can not attend at the current time'
            ],403);
        
        
        $member = auth('api')->user();
        if (!$member->remaining_sessions) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, you can not attend this session as your session packages has ran out'
            ], 403);
        }




        // Passes all validations and attend the session
        $member->remaining_sessions--;
        $member->save();


        // Create a new attendance record
        $attendance = Attendance::create([
            'session_id' => $session->id,
            'member_id' => $member->id,
            'attended_at'=>Carbon::now()->toDateTimeString(),
        ]);


        // return success
        return response()->json([
            'success' => true,
            'message' => 'Member attended session',
            'data' => [
                'session' => $session,
                'attended_at' => $attendance->attended_at,
                'remaining-sessions' => $member->remaining_sessions,
            ]
        ], 200);
    }

    public function remaining_sessions()
    {
        $member = auth('api')->user();
        return response()->json([
            'total_sessions' => $member->total_sessions,
            'remaining_sessions' => $member->remaining_sessions
        ], 200);
    }

    public function test(Request $request)
    {
        // dd(env('APP_URL').'/storage');
        // Storage::disk('public')->url();
        // dd(Storage::disk('public')->url('members/WiuLDyjoy4SDdO0uwvlcLhBDHK3ZFeBfg3nUjkVg.jpeg'));

        // $avatar = ($request->hasFile('avatar'))? $request->file('avatar')->store('uploads', 'public'):'uploads/members/default.jpeg';

        // dd(public_path()->url());

        // dd($request);
        $requestData = $request->all();

        if ($request->hasFile('avatar')) {
            $requestData['avatar'] = $request->file('avatar')
                ->store('uploads', 'public');
        }
    }
    public function save_avatar($request)
    {
        if ($request->hasFile('input_img')) {
            $image = $request->file('input_img');
            $name   = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
            $this->save();

            return back()->with(' success  ', 'Image Upload successfully');
        }
    }

    public function attendance()
    {
        $member = auth('api')->user();
        return response()->json($member->attendance);
    }
}
