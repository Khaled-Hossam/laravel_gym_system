<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MemberRegisterRequest;
use App\Http\Requests\AttendSessionRequest;
use App\Member;
use App\Session;
use Mail;
use App\VerificationCode;
use Illuminate\Support\Carbon;
use App\Attendance;



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
        $this->send_verification_email($member);

        return response()->json([
            'success' => true,
            'message' => 'Member created successfully',
            'descritption' => 'Please follow the email we have sent you to complete your registration',
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
                // $mail->from(getenv('MAIL_USERNAME'), "laragymvel@gmail.com");
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), "laragymvel@gmail.com");
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
            dd($member);
        }
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

        // checking to see if the member can attend the session
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


        Attendance::create([
            'session_id' => $session->id,
            'member_id' => $member->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Member attended session',
            'data' => [
                'session' => $session,
                'remaining' => $member->remaining_sessions,
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
        $requestData = $request->all();
        // dd($requestData);

        if ($request->hasFile('cover_image')) {
            $requestData['cover_image'] = $request->file('cover_image')
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
}
