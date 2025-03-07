<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasswordChangeController extends Controller
{
    public function password_reset()
    {
        return view('building-admin.password-reset');
    }
}
