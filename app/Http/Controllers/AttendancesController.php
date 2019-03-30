<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendancesController extends Controller
{
    public function getJsonData()
    {
        $attendances = Attendance::with('member', 'session.gym')
        ->whereHas('session.gym', function ($query) {
            return $query->filterAttendanceByMyRole();
        })->get();

        return datatables($attendances)->toJson();
    }

    public function index()
    {
        return view('attendances.index');
    }
}
