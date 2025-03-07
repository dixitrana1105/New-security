<?php

namespace App\Http\Controllers\SchoolSecurity;

use App\Models\SchoolAdminSecurity;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Country;
use App\Models\EmailSetup;
use App\Models\State;
use App\Models\City;

class SettingSecuritySchool extends Controller
{
    public function profile()
    {
        $user =  Auth::guard('schoolsecurity')->user()->id;

        // dd($user);

        $profiles = \App\Models\SchoolAdminSecurity::with('State')->where('id', $user)->get();
        return view('school-security.setting.profile', compact('profiles'));
    }

    public function profile_form()
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();

        $user =  Auth::guard('schoolsecurity')->user()->id;

        // dd($user);

        $profiles = \App\Models\SchoolAdminSecurity::with('State')->where('id', $user)->get();
        return view('school-security.setting.profile-form', compact('profiles', 'country', 'states', 'cities'));
    }


    public function updateProfile(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'logo' => '',
            'business_name' => '',
            'name' => '',
            'contact' => '', 
            'email' => '',
            'address_1' => '',
            'address_2' => '',
            'country' => '',
            'state' => '',
            'city' => '',
        ]);
    
        $user = Auth::guard('schoolsecurity')->user();
    
        $user->business_name = $request->business_name;
        $user->name = $request->name;
        $user->contant_number = $request->contact;
        $user->email = $request->email;
        $user->c_address_1 = $request->address_1;
        $user->c_address_2 = $request->address_2;
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

    public function reset_password()
    {
        return view('school-security.setting.reset-password');
    }



    public function updatePassword(Request $request)
    {


          $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::guard('schoolsecurity')->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['oldpsw' => 'The old password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }
}
