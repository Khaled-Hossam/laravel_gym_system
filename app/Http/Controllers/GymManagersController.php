<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\gymmanager\StoreGymManagerRequest;
use App\Http\Requests\gymmanager\UpdateGymManagerRequest;
use App\User;
use App\Gym;
use App\City;

class GymManagersController extends Controller
{
    public function __construct()
    {
        // Check if user is allowed to crud the specified manager, Add the city id to the request bdoy
        $this->middleware(function ($request, $next) {
            $request['city_id'] = $request->route('user') ?$request->route('user')->city_id:
                Gym::where('id', $request["gym_id"])->first()->value("city_id");
                
            if (!Auth::user()->hasRole('admin')) {
                if (!City::allowedToSeeCities()->get()->contains($request['city_id'])) {
                    return abort(403);
                }
            }
            return $next($request);
        })
            ->only('edit', 'show', 'destroy', 'update', 'store');
    }

    public function getJsonData()
    {
        return datatables(User::with('gym')->whereNotNull('gym_id')->whereNotNull('city_id')->allowedToSeeGymManagers())->toJson();
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
    public function store(StoreGymManagerRequest $request)
    {
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->password);
    
        if ($request->hasFile('avatar')) {
            $requestData['avatar'] = $request->file('avatar')
                ->store('uploads', 'public');
        }

        User::create($requestData)->assignRole('gym_manager');

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
    public function update(UpdateGymManagerRequest $request, User $user)
    {
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


    public function banUser(User $user)
    {
        if ($user->isBanned()) {
            $user->unban();
        } else {
            $user->ban();
        }
        return back();
    }
}
