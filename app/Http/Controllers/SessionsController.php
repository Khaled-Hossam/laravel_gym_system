<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Session;
use Illuminate\Http\Request;
use App\Gym;

class SessionsController extends Controller
{
    public function getJsonData(){
        return datatables( Session::all() )->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {        
        return view('sessions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $gyms = Gym::all();
        return view('sessions.create', compact('gyms'));
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
			'name' => 'required|max:80',
			'starts_at' => 'required',
			'finishes_at' => 'required'
		]);
        $requestData = $request->all();
        
        Session::create($requestData);

        return redirect('sessions')->with('flash_message', 'Session added!');
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
        $session = Session::findOrFail($id);

        return view('sessions.show', compact('session'));
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
        $session = Session::findOrFail($id);
        $gyms = Gym::all();

        return view('sessions.edit', compact('session','gyms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'name' => 'required|max:80',
			'starts_at' => 'required',
			'finishes_at' => 'required'
		]);
        $requestData = $request->all();
        
        $session = Session::findOrFail($id);
        $session->update($requestData);

        return redirect('sessions')->with('flash_message', 'Session updated!');
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
        Session::destroy($id);
    }
}
