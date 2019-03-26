<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Gym;
use App\City;
use App\User;
use Illuminate\Http\Request;

class GymsController extends Controller
{
    public function getJsonData(){
        return datatables( Gym::with('city','creator') )->toJson();
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
        $cities = City::pluck('name', 'id');;
        $users = User::pluck('name', 'id');;

        return view('gyms.create',compact('cities','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required|string|max:180',
			'city_id' => 'exists:cities,id',
			'creator_id' => 'exists:users,id'
		]);
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
        $cities = City::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('gyms.edit', compact('gym','cities','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Gym $gym)
    {
        $this->validate($request, [
			'name' => 'required|string|max:180',
			'city_id' => 'exists:cities,id',
			'creator_id' => 'exists:users,id'
		]);
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
