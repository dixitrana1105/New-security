<?php

namespace App\Http\Controllers\SchoolAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolEmailSetup;
use App\Models\Building_Master;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\EmailSetup;
use App\Models\State;
use App\Models\City;


use Illuminate\Support\Facades\Auth;

class SettingSchoolController extends Controller
{
    public function profile()
    {
       $user =  Auth::guard('buildingadmin')->user()->id;

       $profiles = \App\Models\Building_Master::with('State')->where('id', $user)->get();

    //    dd($profiles);

    //    dd($auth);
        // dd($profiles);
        return view('school-admin.setting.profile', compact('profiles'));    
    }

    public function profile_form()
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();

        $user = Auth::guard('buildingadmin')->user()->id;

        // dd($user);

        $profiles = \App\Models\Building_Master::with('State')->where('id', $user)->get();
        return view('school-admin.setting.profile-form', compact('profiles', 'country', 'states', 'cities'));
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
    
        $user = Auth::guard('buildingadmin')->user();
    
        $user->business_name = $request->business_name;
        $user->name = $request->name;
        $user->contact_number = $request->contact;
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



    public function email()
    {

        // $currentUser = Building_Master::('type', 'school')->whereget();


        // $currentUser = Auth::guard('buildingadmin')->user()->id;
        $setups = \App\Models\SchoolEmailSetup::all();
        // dd($setups);
        return view('school-admin.setting.email', compact('setups'));
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

        $emailSetup = SchoolEmailSetup::where('added_by', $addedBy)->first();

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

            $emailSetup = new SchoolEmailSetup();
            $emailSetup->mail_driver = $request->input('mail_driver');
            $emailSetup->mail_host = $request->input('mail_host');
            $emailSetup->mail_port = $request->input('mail_port');
            $emailSetup->mail_username = $request->input('mail_username');
            $emailSetup->mail_password = $request->input('mail_password');
            $emailSetup->mail_ency = $request->input('mail_ency');
            $emailSetup->mail_address = $request->input('mail_address');
            $emailSetup->mail_name = $request->input('mail_name');
            // $emailSetup->mail_test_email = $request->input('mail_test_email');
            $emailSetup->added_by = Auth::guard('buildingadmin')->user()->id; // Save the current user's ID
        }

        $emailSetup->save();

        return redirect()->back()->with('success', 'Email setup saved successfully!');
    }

    public function reset_key()
    {
        return view('school-admin.setting.reset-key');
    }

    public function reset_password()
    {

        // dd('ok');
        
        return view('school-admin.setting.reset-password');
    }




    public function updatePassword(Request $request)
    {


          $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::guard('buildingadmin')->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['oldpsw' => 'The old password is incorrect.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }


    public function update_key(Request $request)
{
    $request->validate([
        'newKey' => 'required|numeric',
    ]);

    $user = Auth::guard('buildingadmin')->user();

    if ($user) {
        $user->secret_key = $request->newKey;
        $user->save();

        return redirect()->back()->with('success', 'Secret Key has been updated successfully!');
    }

    return redirect()->back()->with('error', 'Unable to reset key. Please try again.');
}

}
