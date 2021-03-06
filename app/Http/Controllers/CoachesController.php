<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Coach;
use App\Http\Requests\coach\UpdateCoachRequest;
use App\Http\Requests\coach\StoreCoachRequest;

class CoachesController extends Controller
{
    public function getJsonData()
    {
        return datatables(Coach::all())->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('coaches.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('coaches.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCoachRequest $request)
    {
        $requestData = $request->all();
        
        Coach::create($requestData);

        return redirect('coaches')->with('flash_message', 'Coach added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $coach = Coach::findOrFail($id);

        return view('coaches.show', compact('coach'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $coach = Coach::findOrFail($id);

        return view('coaches.edit', compact('coach'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateCoachRequest $request, $id)
    {
        $requestData = $request->all();
        
        $coach = Coach::findOrFail($id);
        $coach->update($requestData);

        return redirect('coaches')->with('flash_message', 'Coach updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Coach::destroy($id);
    }
}
