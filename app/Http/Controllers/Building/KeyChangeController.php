<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class KeyChangeController extends Controller
{
    public function key_reset()
    {
        return view('building-admin.key-reset');
    }

    public function update_key(Request $request)
    {
        $request->validate([
            'newKey' => 'required|numeric',
        ]);

        $user = Auth::guard('buildingadmin')->user();
        $user->secret_key = $request->newKey;
        $user->save();

        return redirect()->back()->with('success', 'Key has been updated successfully!');
    }
}
