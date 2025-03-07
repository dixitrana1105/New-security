<?php

namespace App\Http\Controllers\BuildingTenant;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsTenantProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::guard('buildingtenant')->user()->id;

        // dd($user);

        $profiles = \App\Models\BuildingAdminTenant::where('id', $user)->get();

        // dd($profiles);
        return view('building-tenant.profile', compact('profiles'));
    }

    public function profile_form()
    {

        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();

        $user = Auth::guard('buildingtenant')->user()->id;

        // dd($user);

        $profiles = \App\Models\BuildingAdminTenant::with('State')->where('id', $user)->get();

        // dd($profiles);
        return view('building-tenant.profile-form', compact('profiles', 'country', 'states', 'cities'));
    }

    public function updateProfile(Request $request)
    {

        $request->validate([
            'logo' => '',
            'business_name' => '',
            'contact_person' => '',
            'contact_number' => '',
            'email' => '',
            'current_address_1' => '',
            'current_address_2' => '',
            'country' => '',
            'state' => '',
            'city' => '',
        ]);

        $user = Auth::guard('buildingtenant')->user();

        $user->business_name = $request->business_name;
        $user->contact_person = $request->contact_person;
        $user->contact_number = $request->contact_number;
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

}
