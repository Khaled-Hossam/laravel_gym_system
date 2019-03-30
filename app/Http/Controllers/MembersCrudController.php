<?php

namespace App\Http\Controllers;

use App\Http\Requests\member\StoreMemberRequest;
use App\Http\Requests\member\UpdateMemberRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class MembersCrudController extends Controller
{
    public function getJsonData()
    {
        return datatables(Member::all())->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('members.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreMemberRequest $request)
    {
        $requestData = $request->all();
        $requestData['password'] = Hash::make($request->password);
    
        if ($request->hasFile('avatar')) {
            $requestData['avatar'] = $request->file('avatar')
                ->store('uploads', 'public');
        }

        Member::create($requestData);

        return redirect('members')->with('flash_message', 'Member added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {
        $requestData = $request->all();
        if (!$request->password) {
            $requestData['password'] = $member->password;
        } else {
            $requestData['password'] = Hash::make($member->password);
        }
        if ($request->hasFile('avatar')) {
            if ($member->avatar) {
                Storage::disk('public')->delete($member->avatar);
            }
            $requestData['avatar'] = $request->file('avatar')
                ->store('uploads', 'public');
        }

        $member->update($requestData);
        
        return redirect('members')->with('flash_message', 'Member updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Member $member)
    {
        if ($member->avatar) {
            Storage::disk('public')->delete($member->avatar);
        }
        $member->delete();
    }
}
