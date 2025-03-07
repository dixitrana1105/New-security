<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Building_Master;
use Illuminate\Support\Facades\Auth;

class SchoolController extends Controller
{   
    public function create_school()
    {
        $latestSchoolID = Building_Master::latest('school_id')->where('type','school')->first();

        if($latestSchoolID) {
            $lastId = intval($latestSchoolID->school_id);
            $nextId = str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);  
        } else {
            $nextId = '211111'; 
        }
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();
        return view('super-admin.school.create',compact('country', 'states', 'cities','nextId'));
    }

    public function index_school(Request $request)
    {
        $status = $request->input('status');
        $city = Building_Master::select('city')->where('type','school')->get(); 

        $query = Building_Master::with('Country','City')->where('type','school')->where('added_by',  Auth::guard('superadmin')->user()->id);
        if ($status !== null) {
            $query->where('status', $status);
        }
        $school = $query->get();
        return view('super-admin.school.index',compact('school','city'));
    } 
    
    public function edit_school($id)
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();
        $value = Building_Master::where('id', $id)->first();
        return view('super-admin.school.edit',compact('country', 'states', 'cities','value'));
    }    
   
}
