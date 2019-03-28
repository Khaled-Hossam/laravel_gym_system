<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Gym;
use Illuminate\Support\Facades\Auth;

class GymManagersController extends Controller
{
    public function __construct() {
        $this->middleware(function ($request, $next) {
            $is_admin      = Auth::user()->hasRole('admin');
            $is_same_city  = Auth::user()->city_id == $request->route('user')->city_id;

            if(!$is_admin && !$is_same_city)
                return abort(403);
        
            return $next($request);
        })
        ->only('edit','show','destroy','update');
    }

    public function getJsonData()
    {
        return datatables(User::allowedToSeeGymManagers() )->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('gym-managers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $gyms = Gym::allowedToSeeGyms()->pluck('name', 'id');
        return view('gym-managers.create', compact('gyms'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'national_id' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'gym_id'=>'exists:gyms,id',
            'avatar' => 'file|mimes:jpeg,png'
        ]);
        $requestData = $request->all();
        $requestData['city_id']  = Auth::user()->city_id;
        $requestData['password'] = Hash::make($request->password);
    
        if ($request->hasFile('avatar')) {
            $requestData['avatar'] = $request->file('avatar')
                ->store('uploads', 'public');
        }

        User::create($requestData);

        return redirect('gym-managers')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('gym-managers.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $gyms = Gym::allowedToSeeGyms()->pluck('name', 'id');
        return view('gym-managers.edit', compact('user', 'gyms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'national_id' => 'required|string|max:255|unique:users,national_id,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'gym_id'=>'exists:gyms,id',
            'avatar' => 'file|mimes:jpeg,png'
        ]);
        $requestData = $request->all();
        if (!$request->password) {
            $requestData['password'] = $user->password;
        } else {
            $requestData['password'] = Hash::make($user->password);
        }
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $requestData['avatar'] = $request->file('avatar')
                ->store('uploads', 'public');
        }


        $user->update($requestData);

        return redirect('gym-managers')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(User $user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }
        $user->delete();
    }
}
