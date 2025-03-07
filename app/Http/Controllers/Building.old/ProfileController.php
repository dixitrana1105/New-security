<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('building-admin.profile.profile');
    }

    public function profile_form()
    {
        return view('building-admin.profile.profile-form');
    }

}
