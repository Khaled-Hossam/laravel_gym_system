<?php

namespace App\Http\Controllers\GymManagers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class GymManagersBanController extends Controller
{
    public function update(User $user)
    {
        $user->toggleBan();

        return back();
    }
}
