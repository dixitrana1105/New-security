<?php

namespace App\Http\Controllers\SchoolAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\SchoolAdminSecurity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SecuritySchoolController extends Controller
{
    public function security_create()
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();
        return view('school-admin.security.create',compact('country', 'states', 'cities'));
    }

    public function security_index(Request $request)
    {
        $status = $request->input('status');
        $id = Auth::guard('buildingadmin')->user()->id;

        $query = SchoolAdminSecurity::where('added_by',$id);

        if ($status !== null) {
            $query->where('status', $status);  
        }

        $security = $query->get();
        return view('school-admin.security.index',compact('security'));
    }

    public function security_edit($id)
    {
        $value = SchoolAdminSecurity::where('id',$id)->first();
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();
        return view('school-admin.security.edit',compact('country', 'states', 'cities','value'));
    }    

    public function security_store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:school_security,email',
            'contact' => 'required',
            'whatsup' => 'required',
            'current_address_1' => 'required',
            'current_address_2' => 'nullable',
            'landmark' => 'nullable',
            'current_city' => 'required|string',
            'permanent_address_1' => 'required',
            'permanent_address_2' => 'nullable',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'photoId' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'addressProof' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'photo' => 'required|file|mimes:jpg,jpeg,png',
            'workingFromDate' => 'required',
            'password' => 'required',
            'secretkey' => 'required',
        ]);        

        $user = Auth::guard('buildingadmin')->user()->id;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/images/');        
            $securityphoto = $file->move($destinationPath, $filename);        
        }

        if ($request->hasFile('addressProof')) {
            $file = $request->file('addressProof');
            $filename_1 = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/upload/');        
            $securityIdProofPath = $file->move($destinationPath, $filename_1,);        
        }

        if ($request->hasFile('photoId')) {
            $file = $request->file('photoId');
            $filename_2 = time() . '_' . $file->getClientOriginalName();  
            $destinationPath = public_path('assets/upload/');       
            $securityphotoIdProofPath = $file->move($destinationPath, $filename_2,);        
        }

        $data = SchoolAdminSecurity::create([
            'name' => $request->name,
            'contant_number' => $request->contact,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'secret_key' => $request->secretkey,
            'c_address_1' => $request->current_address_1,
            'c_address_2' => $request->current_address_2,
            'current_city' => $request->current_city,
            'whatsapp' => $request->whatsup,
            'c_landmark' => $request->landmark,
            'p_address_1' => $request->permanent_address_1,
            'p_address_2' => $request->permanent_address_2,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'photo_id' => $filename_2,
            'address_proof' => $filename_1,
            'photo' => $filename,
            'working_date' => $request->workingFromDate,
            'added_by' => $user,
            'status' => 1,
        ]);

        return redirect()->route('school.security.index')->with('success', 'Security added successfully');
    }

    public function security_update(Request $request,  $id)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:school_security,email,'.$id,
            'contact' => 'required',
            'whatsup' => 'required',
            'current_address_1' => 'required',
            'current_address_2' => 'nullable',
            'landmark' => 'nullable',
            'current_city' => 'required|string',
            'permanent_address_1' => 'required',
            'permanent_address_2' => 'nullable',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'photoId' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'addressProof' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
            'photo' => 'nullable|file|mimes:jpg,jpeg,png',
            'workingFromDate' => 'required',
            'password' => 'nullable',
            'secretkey' => 'required',
        ]);  
        
        $security = SchoolAdminSecurity::findOrFail($id);
        $user = Auth::guard('buildingadmin')->user()->id;

        $filename = $security->photo;
        $filename_1 = $security->address_proof;
        $filename_2 = $security->photo_id;
    

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName(); 
            $destinationPath = public_path('assets/images/');      
            $securityphoto = $file->move($destinationPath, $filename);        
        }

        if ($request->hasFile('addressProof')) {
            $file = $request->file('addressProof');
            $filename_1 = time() . '_' . $file->getClientOriginalName(); 
            $destinationPath = public_path('assets/upload/');        
            $securityIdProofPath = $file->move($destinationPath, $filename_1,);        
        }

        if ($request->hasFile('photoId')) {
            $file = $request->file('photoId');
            $filename_2 = time() . '_' . $file->getClientOriginalName();   
            $destinationPath = public_path('assets/upload/');         
            $securityphotoIdProofPath = $file->move($destinationPath, $filename_2,);        
        }

        $security->update([
            'name' => $request->name,
            'contant_number' => $request->contact,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'secret_key' => $request->secretkey,
            'c_address_1' => $request->current_address_1,
            'c_address_2' => $request->current_address_2,
            'current_city' => $request->current_city,
            'whatsapp' => $request->whatsup,
            'c_landmark' => $request->landmark,
            'p_address_1' => $request->permanent_address_1,
            'p_address_2' => $request->permanent_address_2,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address_proof' => $filename_1,
            'photo' => $filename,
            'photo_id' => $filename_2,
            'working_date' => $request->workingFromDate,
            'edited_by' => $user,
            'status' => 1,
        ]);

        return redirect()->route('school.security.index')->with('success', 'Security updated successfully');
    }


    public function security_status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $data = SchoolAdminSecurity::findOrFail($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

}