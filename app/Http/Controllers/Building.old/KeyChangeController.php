<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeyChangeController extends Controller
{
    public function key_reset()
    {
        return view('building-admin.key-reset');
    }
}
