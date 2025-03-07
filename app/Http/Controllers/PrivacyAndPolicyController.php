<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrivacyAndPolicyController extends Controller
{
    public function privacy_policy()
    {
        return view('privacy-policy');
    }
}
