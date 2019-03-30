<?php

namespace App\Http\Controllers\GymManagers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class GymManagersBanController extends Controller
{
    public function update(User $user)
    {
        if ($user->isBanned()) {
            $user->unban();
        } else {
            $user->ban();
        }
        return back();
    }
}
