<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecurityController extends Controller
{

    public function index_security()
    {
        return view('building-admin.security.index');
    }


    public function create_security()
    {
        return view('building-admin.security.create');
    }

    public function edit_security()
    {
        return view('building-admin.security.edit');
    }
}
