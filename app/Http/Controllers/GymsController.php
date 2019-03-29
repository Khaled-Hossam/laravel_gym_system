<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\gym\StoreGymRequest;
use App\Http\Requests\gym\UpdateGymRequest;
use App\Gym;
use App\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GymsController extends Controller
{
    public function __construct()
    {
        // check if user is allowed to crud this specific gym
        $this->middleware(function ($request, $next) {
            if ($request->route('gym') != null) {
                $city_id = $request->route('gym')->city_id;
            } else {
                $city_id = $request->city_id;
            }

            if (!Gym::allowedToSeeGyms()->get()->contains($city_id)) {
                return abort(403);
            }

            return $next($request);
        })
            ->only('edit', 'show', 'destroy', 'update', 'store');
    }

    public function getJsonData()
    {
        return datatables(Gym::allowedToSeeGyms()->with('city', 'creator'))->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('gyms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = City::allowedToSeeCities()->pluck('name', 'id');
        return view('gyms.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreGymRequest $request)
    {
        
        $request['creator_id'] = Auth::user()->id;
        $requestData = $request->all();

        if ($request->hasFile('cover_image')) {
            $requestData['cover_image'] = $request->file('cover_image')
                ->store('uploads', 'public');
        }

        Gym::create($requestData);

        return redirect('gyms')->with('flash_message', 'Gym added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Gym $gym)
    {
        return view('gyms.show', compact('gym'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Gym $gym)
    {
        $cities = City::allowedToSeeCities()->pluck('name', 'id');
        return view('gyms.edit', compact('gym', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateGymRequest $request, Gym $gym)
    {

        $request['creator_id'] = Auth::user()->id;
        $requestData = $request->all();
        if ($request->hasFile('cover_image')) {
            $requestData['cover_image'] = $request->file('cover_image')
                ->store('uploads', 'public');
        }

        $gym->update($requestData);

        return redirect('gyms')->with('flash_message', 'Gym updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Gym $gym)
    {
        $gym->delete();
    }
}
