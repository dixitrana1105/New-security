<?php

namespace App\Http\Controllers\BuildingSecurity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Country;
use App\Models\EmailSetup;
use App\Models\State;
use App\Models\City;


use App\Models\Building_Security;

class BuildingsSecurityProfileController extends Controller
{
    public function profile()
    {

        $user = Auth::guard('buildingSecutityadmin')->user()->id;

        // dd($user);

        $profiles = \App\Models\Security_Master::with('State')->where('id', $user)->get();
        return view('building-security.profile', compact('profiles'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'logo' => '',
            'business_name' => '',
            'name' => '',
            'contact' => '', 
            'email' => '',
            'current_address_1' => '',
            'current_address_2' => '',
            'country' => '',
            'state' => '',
            'city' => '',
        ]);
    
        $user = Auth::guard('buildingSecutityadmin')->user();
    
        $user->business_name = $request->business_name;
        $user->name = $request->name;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->current_address_1 = $request->current_address_1;
        $user->current_address_2 = $request->current_address_2;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
    
        if ($request->hasFile('logo')) {
            $destinationPath = public_path('assets/images/');
    
            $logoFileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($destinationPath, $logoFileName);
    
            $user->logo = 'assets/images/' . $logoFileName;
        }
    
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



    public function profile_form()
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();

        $user = Auth::guard('buildingSecutityadmin')->user()->id;

        // dd($user);

        $profiles = \App\Models\Security_Master::with('State')->where('id', $user)->get();

        return view('building-security.profile-form', compact('profiles', 'country', 'states', 'cities'));
    }

}
