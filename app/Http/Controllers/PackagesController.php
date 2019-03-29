<?php

namespace App\Http\Controllers;
use App\Http\Requests\package\StorePackageRequest;
use App\Http\Requests\package\UpdatePackageRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function getJsonData(){
        return datatables( Package::all() )->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {        
        return view('packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StorePackageRequest $request)
    {
        
        $requestData = $request->all();
        
        Package::create($requestData);

        return redirect('packages')->with('flash_message', 'Package added!');
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
        $package = Package::findOrFail($id);

        return view('packages.show', compact('package'));
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
        $package = Package::findOrFail($id);

        return view('packages.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdatePackageRequest $request, $id)
    {
       
        $requestData = $request->all();
        
        $package = Package::findOrFail($id);
        $package->update($requestData);

        return redirect('packages')->with('flash_message', 'Package updated!');
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
        Package::destroy($id);
    }
}
