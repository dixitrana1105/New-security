<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Country;
use App\Models\EmailSetup;
use App\Models\State;
use App\Models\City;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('buildingadmin')->user()->id;

        // dd($user);

        $profiles = \App\Models\Building_Master::with('State')->where('id', $user)->get();

        // dd($profiles);
        return view('building-admin.profile.profile', compact('profiles'));
    }

    public function profile_form()
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();

        $user = Auth::guard('buildingadmin')->user()->id;

        // dd($user);

        $profiles = \App\Models\Building_Master::with('State')->where('id', $user)->get();

        return view('building-admin.profile.profile-form',  compact('profiles', 'country', 'states', 'cities'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'logo' => '',
            'business_name' => '',
            'name' => '',
            'contact_number' => '', 
            'email' => '',
            'address_1' => '',
            'address_2' => '',
            'country' => '',
            'state' => '',
            'city' => '',
        ]);
    
        $user = Auth::guard('buildingadmin')->user();
    
        $user->business_name = $request->business_name;
        $user->name = $request->name;
        $user->contact_number = $request->contact_number;
        $user->email = $request->email;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
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
    

}
