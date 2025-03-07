<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Security_Master;
use App\Models\Country;
use App\Models\EmailSetup;
use App\Models\State;
use App\Models\City;

class SecurityController extends Controller
{

    public function index_security(Request $request)
    {
        $buildingAdminId = Auth::guard('buildingadmin')->user()->id;
        // dd($buildingAdminId);
    
        $statusFilter = $request->input('statusFilter', 'all');
    
        $query = Security_Master::where('building_id', $buildingAdminId);
    
        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter === 'active' ? 1 : 0);
        }
    
        $security_data = $query->orderBy('created_at', 'desc')->get();
    
        return view('building-admin.security.index', compact('security_data'));
    }


    public function create_security()
    {
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();
        return view('building-admin.security.create', compact('country', 'states', 'cities'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => '',
            'contact' => '',
            'current_city' => '',
            'whatsup' => '',
            'email' => '',
            'current_address_1' => '',
            'current_address_2' => '',
            'landmark' => '',
            'city' => '',
            'permanent_address_1' => '',
            'permanent_address_2' => '',
            'country' => '',
            'state' => '',
            'workingFromDate' => '',
            'password' => '',
            'secretkey' => '',
             'photo' => '',
            'addressproof' => '',
            'tenantPhoto' => '',
            'logo' => '',
        ]);

        // dd('ok');

        $user = Auth::guard('buildingadmin')->user()->id;



        if ($request->hasFile('photo')) {
            $destinationPath = public_path('assets/images/');
    
            $photoFileName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move($destinationPath, $photoFileName);
    
            $photoPath = 'assets/images/' . $photoFileName;
        }     



     

        if ($request->hasFile('addressproof')) {
            $destinationPath = public_path('assets/images/');
    
            $addressproofFileName = time() . '_' . $request->file('addressproof')->getClientOriginalName();
            $request->file('addressproof')->move($destinationPath, $addressproofFileName);
    
            $addressproofPath = 'assets/images/' . $addressproofFileName;
        }     

      

        if ($request->hasFile('tenantPhoto')) {
            $destinationPath = public_path('assets/images/');
    
            $tenantPhotoFileName = time() . '_' . $request->file('tenantPhoto')->getClientOriginalName();
            $request->file('tenantPhoto')->move($destinationPath, $tenantPhotoFileName);
    
            $tenantPhotoPath = 'assets/images/' . $tenantPhotoFileName;
        }     


        if ($request->hasFile('logo')) {
            $destinationPath = public_path('assets/images/');
    
            $logoFileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($destinationPath, $logoFileName);
    
            $logoPath = 'assets/images/' . $logoFileName;
        }            


        $security_id = 'SU' . rand(111111, 999999);
        $building_id = Auth::guard('buildingadmin')->user()->id;



        $data = Security_Master::create([
            'security_id' => $security_id,
            'building_id' => $building_id,
            'name' => $request->name,
            'contact' => $request->contact,
            'whatsup' => $request->whatsup,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'secret_key' => $request->secret_key,
            'current_address_1' => $request->current_address_1,
            'current_address_2' => $request->current_address_2,
            'current_city' => $request->current_city,
            'landmark' => $request->landmark,
            'city' => $request->city,
            'workingFromDate' => $request->workingFromDate,
            'permanent_address_1' => $request->permanent_address_1,
            'permanent_address_2' => $request->permanent_address_2,
            'country' => $request->country,
            'state' => $request->state,
            'added_by' => $user,
            'status' => 1,
            'photo' => $photoPath,
            'addressproof' => $addressproofPath,
            'tenantPhoto' => $tenantPhotoPath,
            'logo' => $logoPath,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        return redirect()->route('building-admin.security-index')->with('success', 'Security created successfully.');


    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => '',
            'contact' => '',
            'current_city' => '',
            'whatsup' => '',
            'email' => '',
            'current_address_1' => '',
            'current_address_2' => '',
            'landmark' => '',
            'city' => '',
            'permanent_address_1' => '',
            'permanent_address_2' => '',
            'country' => '',
            'state' => '',
            'workingFromDate' => '',
            'password' => '',
            'secretkey' => '',
             'photo' => '',
            'addressproof' => '',
            'tenantPhoto' => '',
            'logo' => '',
        ]);
    
        $tenant = Security_Master::findOrFail($id);
    
        $user = Auth::guard('buildingadmin')->user()->id;
    
        $photoPath = $tenant->photo;
        $addressproofPath = $tenant->addressproof;
        $tenantPhotoPath = $tenant->tenantPhoto;
        $logoPath = $tenant->logo;
    
        if ($request->hasFile('photo')) {
            $destinationPath = public_path('assets/images/');
    
            $photoFileName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move($destinationPath, $photoFileName);
    
            $photoPath = 'assets/images/' . $photoFileName;
        }     



     

        if ($request->hasFile('addressproof')) {
            $destinationPath = public_path('assets/images/');
    
            $addressproofFileName = time() . '_' . $request->file('addressproof')->getClientOriginalName();
            $request->file('addressproof')->move($destinationPath, $addressproofFileName);
    
            $addressproofPath = 'assets/images/' . $addressproofFileName;
        }     

      

        if ($request->hasFile('tenantPhoto')) {
            $destinationPath = public_path('assets/images/');
    
            $tenantPhotoFileName = time() . '_' . $request->file('tenantPhoto')->getClientOriginalName();
            $request->file('tenantPhoto')->move($destinationPath, $tenantPhotoFileName);
    
            $tenantPhotoPath = 'assets/images/' . $tenantPhotoFileName;
        }     


        if ($request->hasFile('logo')) {
            $destinationPath = public_path('assets/images/');
    
            $logoFileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move($destinationPath, $logoFileName);
    
            $logoPath = 'assets/images/' . $logoFileName;
        }            


        // dd('ok');
    
        $tenant->update([
            'name' => $request->name,
            'contact' => $request->contact,
            'whatsup' => $request->whatsup,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $tenant->password,
            'secret_key' => $request->secret_key,
            'current_address_1' => $request->current_address_1,
            'current_address_2' => $request->current_address_2,
            'current_city' => $request->current_city,
            'landmark' => $request->landmark,
            'city' => $request->city,
            'workingFromDate' => $request->workingFromDate,
            'permanent_address_1' => $request->permanent_address_1,
            'permanent_address_2' => $request->permanent_address_2,
            'country' => $request->country,
            'state' => $request->state,
            'photo' => $photoPath,
            'addressproof' => $addressproofPath,
            'tenantPhoto' => $tenantPhotoPath,
            'logo' => $logoPath,
            'edited_by' => $user,
            'status' => 1,
        ]);
    
        return redirect()->route('building-admin.security-index')->with('success', 'Security updated successfully.');
    }

    public function edit_security($id)
    {
        // Retrieve the specific security entry by ID and added_by (current admin)
        $security = \App\Models\Security_Master::where('id', $id)
            ->where('added_by', Auth::guard('buildingadmin')->user()->id)
            ->first();

            $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
            $states = State::select('id', 'name', 'country_id')->get();
            $cities = City::select('id', 'name', 'state_id')->get();

            // dd($security_data);

        if (!$security) {
            return redirect()->back()->with('error', 'Security entry not found or unauthorized');
        }

        // Pass the retrieved security data to the view
        return view('building-admin.security.edit', compact('security', 'country', 'states', 'cities'));
    }

    public function status_security(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $data = Security_Master::findOrFail($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

}
