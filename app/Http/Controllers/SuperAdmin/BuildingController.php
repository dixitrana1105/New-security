<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Building_Master;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{   
    public function create_building()
    {
        $latestBuildingID = Building_Master::latest('building_id')->where('type','building')->first();

        if($latestBuildingID) {
            $lastId = intval($latestBuildingID->building_id);
            $nextId = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);  
        } else {
            $nextId = '11111'; 
        }
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();
        return view('super-admin.building.create',compact('country', 'states', 'cities','nextId'));
    }

    public function index_building(Request $request)
    {
        $status = $request->input('status');
        $cityfilter = $request->input('city');

        // dd(Auth::guard('superadmin')->user()->id);

        $city = Building_Master::select('city')->where('type','building')->get(); 
        $query = Building_Master::with('Country','City')->where('type','building')->where('added_by',  Auth::guard('superadmin')->user()->id);
        if ($status !== null) {
            $query->where('status', $status);
        }

        if ($cityfilter !== null) {
            $query->where('city', $cityfilter);
        }

        $building = $query->get();
        return view('super-admin.building.index',compact('building','city'));
    } 
    
    public function edit_building($id)
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();
        $value = Building_Master::where('id', $id)->first();
        return view('super-admin.building.edit',compact('country', 'states', 'cities','value'));
    }

    public function store(Request $request)
    {

        $type = $request->input('type');       

        if($type == 'building'){

        $validatedData = $request->validate([
            'date' => 'required',
            'buildingId' => 'required',
            'buildingname' => 'required',
            'business_name' => '',
            'typeofbuilding' => 'required',
            'email' => 'required',
            'password' => 'required',
            'secretkey' => 'required',
            'name' => 'required',
            'contact' => 'nullable',
            'notenant' => 'required',
            'security' => 'required',
            'address_1' => 'required',
            'address_2' => 'nullable',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required'
        ]);

        $user = Auth::guard('superadmin')->user()->id;
        $data = Building_Master::create([
            'date' => $request->date,
            'building_id' => $request->buildingId,
            'type' => $request->type,
            'name' => $request->buildingname,
            'business_name' => $request->business_name,
            'type_of_building' => $request->typeofbuilding,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'secret_key' => $request->secretkey,
            'contact_person' => $request->name,
            'contact_number' => $request->contact,
            'no_of_tenant' => $request->notenant,
            'no_security_person' => $request->security,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'added_by' => $user,
            'status' => 1,

        ]);

        return redirect()->route('super-admin.building-index')->with('success', 'Building created successfully.');


    }else{
        $validatedData = $request->validate([
            'date' => 'required',
            'schoolId' => 'required',
            'schoolname' => 'required',
            'email' => 'required',
            'password' => 'required',
            'business_name' => '',
            'secretkey' => 'required',
            'name' => 'required',
            'contact' => 'nullable',
            'security' => 'required',
            'address_1' => 'required',
            'address_2' => 'nullable',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required'
        ]);

        $user = Auth::guard('superadmin')->user()->id;
        $data = Building_Master::create([
            'date' => $request->date,
            'type' => 'school',
            'school_id' => $request->schoolId,
            'name' => $request->schoolname,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'secret_key' => $request->secretkey,
            'business_name' => $request->business_name,
            'contact_person' => $request->name,
            'contact_number' => $request->contact,
            'no_security_person' => $request->security,
            'type_of_building' => 4,
            'address_1' => $request->address_1,
            'address_2' => $request->address_2,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'added_by' => $user,
            'status' => 1,

        ]);

        return redirect()->route('super-admin.school-index')->with('success', 'Building created successfully.');



    }
    
    }

    public function update_building(Request $request, $id)
{

    $type = $request->input('type');       

    if($type == 'building'){

    $validatedData = $request->validate([
        'date' => 'required',
        'buildingId' => 'required',
        'buildingname' => 'required',
        'typeofbuilding' => 'required',
        'business_name' => '',
        'email' => 'required|email',
        'name' => 'required',
        'contact' => 'nullable',
        'notenant' => 'required|integer',
        'security' => 'required|integer',
        'address_1' => 'required',
        'address_2' => 'nullable',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required',
    ]);

    $user = Auth::guard('superadmin')->user()->id;
    $building = Building_Master::findOrFail($id);

    $building->update([
        'date' => $request->date,
        'building_id' => $request->buildingId,
        'type' => $request->type,
        'name' => $request->buildingname,
        'business_name' => $request->business_name,
        'type_of_building' => $request->typeofbuilding,
        'email' => $request->email,
        'password' => Hash::make($request->password), 
        'secret_key' => $request->secretkey,
        'contact_person' => $request->name,
        'contact_number' => $request->contact,
        'no_of_tenant' => $request->notenant,
        'no_security_person' => $request->security,
        'address_1' => $request->address_1,
        'address_2' => $request->address_2,
        'country' => $request->country,
        'state' => $request->state,
        'edited_by' => $user,
        'city' => $request->city,       
    ]);

    return redirect()->route('super-admin.building-index')->with('success', 'Building updated successfully.');
}else{

    $validatedData = $request->validate([
        'date' => 'required',
        'schoolId' => 'required',
        'schoolname' => 'required',
        'email' => 'required',
        'name' => 'required',
        'contact' => 'nullable',
        'security' => 'required',
        'business_name' => '',
        'address_1' => 'required',
        'address_2' => 'nullable',
        'country' => 'required',
        'state' => 'required',
        'city' => 'required'
    ]);

    $user = Auth::guard('superadmin')->user()->id;
    $school = Building_Master::findOrFail($id);
    $school->update([
        'date' => $request->date,
        'type' => 'school',
        'school_id' => $request->schoolId,
        'name' => $request->schoolname,
        'business_name' => $request->business_name,
        'email' => $request->email,
        'password' => Hash::make($request->password), 
        'secret_key' => $request->secretkey,
        'contact_person' => $request->name,
        'contact_number' => $request->contact,
        'no_security_person' => $request->security,
        'type_of_building' => 4,
        'address_1' => $request->address_1,
        'address_2' => $request->address_2,
        'country' => $request->country,
        'state' => $request->state,
        'city' => $request->city,
        'edited_by' => $user,
        'status' => 1,

    ]);

    return redirect()->route('super-admin.school-index')->with('success', 'Building update successfully.');



}
}


    public function statusUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $data = Building_Master::findOrFail($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }
   
}
