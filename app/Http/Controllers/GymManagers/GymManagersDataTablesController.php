<?php

namespace App\Http\Controllers\GymManagers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class GymManagersDataTablesController extends Controller
{
    public function index()
    {
        return datatables(User::allowedToSeeGymManagers())->toJson();
    }
}
