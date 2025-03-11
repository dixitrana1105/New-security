<?php

namespace App\Http\Controllers;
use App\Models\BuildingAdminTicket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SuperAdmin;
use App\Models\Building_Master;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $id = Auth::guard('superadmin')->user()->id;

        $commercial = Building_Master::where('added_by',$id)->where('type_of_building',1)
        ->count();
        $ressidential = Building_Master::where('added_by',$id)->where('type_of_building',2)
        ->count();
        $commercial_ressidential = Building_Master::where('added_by',$id)->where('type_of_building',3)
        ->count();
        $school = Building_Master::where('added_by',$id)->where('type_of_building',4)
        ->count();


        $countStatus1 = BuildingAdminTicket::where('status_of_button', 1)->count();
        $countStatus2 = BuildingAdminTicket::where('status_of_button', 2)->count();
        $countStatus0 = BuildingAdminTicket::where('status_of_button', 0)->count();
        $countNull = BuildingAdminTicket::where('status_of_button', null)->count();
        $totalCount = BuildingAdminTicket::count();


        return view('super-admin.dashboard',compact('school','commercial','ressidential','commercial_ressidential',
    'countStatus1', 'countStatus2', 'countStatus0', 'totalCount', 'countNull'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'secret_key' => 'required',
        ]);

        if (Auth::guard('superadmin')->attempt([

            'email' => $request->email,
            'password' => $request->password,
            'secret_key' => $request->secret_key,
        ])) {

            return redirect()->route('super-admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }


    public function logout()
    {
        $redirectTo = session('url.intended', '/');

        Auth::logout();

        session()->flush();
        session()->regenerate();

        return redirect($redirectTo);
    }

}
