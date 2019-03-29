<?php

namespace App\Http\Controllers;

use App\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendancesController extends Controller
{
    public function getJsonData()
    {
        $attendances = Attendance::with('member','session.gym')->whereHas(
            'session.gym', function($query){
                if(Auth::user()->hasRole('city_manager'))
                    $query->where('city_id', Auth::user()->city_id);
                if(Auth::user()->hasRole('gym_manager'))
                    $query->where('gym_id', Auth::user()->gym_id);
            })->get();

        return datatables($attendances)->toJson();
    }

    public function index()
    {
        return view('attendances.index');
    }
}
