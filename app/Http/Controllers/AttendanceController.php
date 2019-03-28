<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Session;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
class AttendanceController extends Controller
{
    public function getJsonData(){
        
        return datatables( Attendance::with('member','session') )->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('attendance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\atttendance  $atttendance
     * @return \Illuminate\Http\Response
     */
    public function show(atttendance $atttendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\atttendance  $atttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(atttendance $atttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\atttendance  $atttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, atttendance $atttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\atttendance  $atttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(atttendance $atttendance)
    {
        //
    }
}
