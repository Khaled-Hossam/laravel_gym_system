<?php

namespace App\Http\Controllers;

use App\City;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Requests\city\StoreCityRequest;
use App\Http\Requests\city\UpdateCityRequest;
class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    { 
        return view('cities.index');
    }
    public function getJsonData()

    {  
        return datatables(City::with('Country'))->toJson();
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
       return view('cities.create',['countries' => Country::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {  
        City::create($request->all());
        return redirect()->route('cities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show( $city)
    {
        return view('cities.show', ['city' => City::findOrFail($city)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    { 
        return view('cities.edit',['countries' => Country::all(),"city"=>$city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, $city)
    {
        City::find($city) -> update($request -> all());
        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy( $city)
    {
        
        City::find($city)->delete($city);

    }
}