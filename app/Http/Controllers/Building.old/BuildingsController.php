<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuildingsController extends Controller
{
    public function dashboard()
    {
        return view('building.dashboard');
    }
}
