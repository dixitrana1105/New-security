<?php

namespace App\Http\Controllers\BuildingTenant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class BuildingsTenantPasswordController extends Controller
{
    public function password_reset()
    {
        return view('building-tenant.password-reset');
    }


    public function updatePassword(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'oldpsw' => 'required',
            'newpsw' => 'required|confirmed',
        ]);

        $user = Auth::guard('buildingtenant')->user();

        if (!Hash::check($request->oldpsw, $user->password)) {
            return redirect()->back()->withErrors(['oldpsw' => 'The old password is incorrect.']);
        }

        $user->password = Hash::make($request->newpsw);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

}
