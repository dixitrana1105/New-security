<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\EmailSetup;
use App\Models\State;
use App\Models\City;


class SettingController extends Controller
{
    public function email()
    {
        $currentUser = Auth::guard('superadmin')->user()->id;
        $setups = \App\Models\EmailSetup::where('added_by', $currentUser)->get();

        // dd($setups);
        return view('super-admin.setting.email', compact('setups'));
    }




    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'mail_driver' => '',
            'mail_host' => '',
            'mail_port' => '',
            'mail_username' => '',
            'mail_password' => '',
            'mail_ency' => '',
            'mail_address' => '',
            'mail_name' => '',
        ]);

        $addedBy = $request->added_by;

        $emailSetup = EmailSetup::where('added_by', $addedBy)->first();

        if ($emailSetup) {
            $emailSetup->mail_driver = $request->input('mail_driver');
            $emailSetup->mail_host = $request->input('mail_host');
            $emailSetup->mail_port = $request->input('mail_port');
            $emailSetup->mail_username = $request->input('mail_username');
            $emailSetup->mail_password = $request->input('mail_password');
            $emailSetup->mail_ency = $request->input('mail_ency');
            $emailSetup->mail_address = $request->input('mail_address');
            $emailSetup->mail_name = $request->input('mail_name');
            // $emailSetup->mail_test_email = $request->input('mail_test_email');
        } else {

            $emailSetup = new EmailSetup();
            $emailSetup->mail_driver = $request->input('mail_driver');
            $emailSetup->mail_host = $request->input('mail_host');
            $emailSetup->mail_port = $request->input('mail_port');
            $emailSetup->mail_username = $request->input('mail_username');
            $emailSetup->mail_password = $request->input('mail_password');
            $emailSetup->mail_ency = $request->input('mail_ency');
            $emailSetup->mail_address = $request->input('mail_address');
            $emailSetup->mail_name = $request->input('mail_name');
            // $emailSetup->mail_test_email = $request->input('mail_test_email');
            $emailSetup->added_by = Auth::guard('superadmin')->user()->id; // Save the current user's ID
        }

        $emailSetup->save();

        return redirect()->back()->with('success', 'Email setup saved successfully!');
    }



    public function profile()
    {

        $currentUser = Auth::guard('superadmin')->user()->id;
        $profiles = \App\Models\User::with('State')->where('added_by', $currentUser)->get();

        // dd($profiles);

        return view('super-admin.setting.profile', compact('profiles'));
    }


    public function updateProfile(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'logo' => '', // Adjust the validation rules as needed
            'business_name' => '',
            'name' => '',
            'contact' => '', // Adjust the validation rules as needed
            'email' => '',
            'address_1' => '',
            'address_2' => '',
            'country' => '',
            'state' => '',
            'city' => '',
        ]);

        // dd($request->all());

        // Find the authenticated user
        $user = Auth::guard('superadmin')->user();

        // Update user profile information
        $user->business_name = $request->business_name;
        $user->name = $request->name;
        $user->contact = $request->contact;
        $user->email = $request->email;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $user->logo = $logoPath;
        }

        // dd($user);
        // Save the updated user profile
        $user->save();

        // Redirect or return a response
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function profile_form()
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();
        $currentUser = Auth::guard('superadmin')->user()->id;

        $profiles = \App\Models\User::where('added_by', $currentUser)->get();
        // dd($profiles);
        return view('super-admin.setting.profile-form', compact('profiles', 'country', 'states', 'cities'));
    }

    public function password_reset()
    {
        // $get_password = \App\Models\User::where('id', Auth::guard('superadmin')->user()->id)->get();
        return view('super-admin.setting.reset-password');
    }


    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::guard('superadmin')->user();

        if (!\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The provided password does not match our records.']);
        }

        $user->password = \Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

   
    public function key_reset()
    {
        return view('super-admin.setting.reset-key');
    }

    public function update_key(Request $request)
    {
        $request->validate([
            'newKey' => 'required|numeric',
        ]);

        $superadmin = Auth::guard('superadmin')->user();

        if ($superadmin) {
            $superadmin->secret_key = $request->newKey;
            $superadmin->save();

            return redirect()->back()->with('success', 'Secret Key has been updated successfully!');
        }

        return redirect()->back()->with('error', 'Unable to reset key. Please try again.');
    }

}
