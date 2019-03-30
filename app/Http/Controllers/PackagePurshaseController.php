<?php

namespace App\Http\Controllers;

use App\GymPackagePurshase;
use App\Gym;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class PackagePurshaseController extends Controller
{
    public function getJsonData()
    {
        $purchases = GymPackagePurshase::with('member', 'gym.city', 'package')
            ->whereHas('gym', function ($query) {
                return $query->allowedToSeeGyms();
            })->get();
        
        return datatables($purchases)->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Auth::user()->hasRole('gym_manager')) {
            $revenues= DB::table('gym_package_purshases')->where('gym_id', '=', Auth::user()->gym_id)->sum('bought_price');
        } elseif (Auth::user()->hasRole('city_manager')) {
            $revenues= DB::table('gym_package_purshases')->join('gyms', 'gyms.id', '=', 'gym_package_purshases.gym_id')->where('city_id', '=', Auth::user()->city_id)->sum('bought_price');
        } else {
            $revenues= DB::table('gym_package_purshases')->sum('bought_price');
        }
            
        return view('revenues.index', ["revenues"=>$revenues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\GymPackagePurshase  $gpp
     * @return \Illuminate\Http\Response
     */
    public function show(GymPackagePurshase $gpp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GymPackagePurshase  $gpp
     * @return \Illuminate\Http\Response
     */
    public function edit(GymPackagePurshase $gpp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GymPackagePurshase  $gpp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GymPackagePurshase $gpp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GymPackagePurshase  $gpp
     * @return \Illuminate\Http\Response
     */
    public function destroy(GymPackagePurshase $gpp)
    {
        //
    }
}
