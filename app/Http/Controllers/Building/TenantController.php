<?php

namespace App\Http\Controllers\Building;

use App\Http\Controllers\Controller;
use App\Models\BuildingAdminTenant;
use App\Models\Building_Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Visitor_Master;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{

    public function index_tenant(Request $request)
    {
        $status = $request->input('status');
        $building_id = Auth::guard('buildingadmin')->user()->id;

        $query = BuildingAdminTenant::where('building_id', $building_id)->whereNull('sub_tenant_id');

        if ($status !== null) {
            $query->where('status', $status);
        }

        $tenant = $query->get();
        return view('building-admin.tenant.index', data: compact('tenant'));
    }

    public function create_tenant()
    {
        $latestTenantID = BuildingAdminTenant::latest('tenant_id')->first();

        if ($latestTenantID) {
            $lastId = intval($latestTenantID->tenant_id);
            $nextId = str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $nextId = '33333';
        }
        return view('building-admin.tenant.create', compact('nextId'));
    }

    public function edit_tenant($id)
    {
        $value = BuildingAdminTenant::where('id', $id)->first();
        return view('building-admin.tenant.edit', compact('value'));
    }

    public function sub_tenant_index()
    {

        $buildingAdminId = Auth::guard('buildingadmin')->user()->id;
        $building_id = Auth::guard('buildingadmin')->user()->building_id;


        $tenant_data = BuildingAdminTenant::whereNotNull('sub_tenant_id')
        ->where('building_id', $buildingAdminId)
        ->where('status', 1)
        ->get();




        return view('building-admin.sub-tenant.index', compact('tenant_data'));
    }

    public function visitor_log_index(Request $request)
    {

        $building_id = Auth::guard('buildingadmin')->user()->id;


        $tenants = Visitor_Master::
            where('building_id', $building_id)
            ->get();

        $query = Visitor_Master::where('building_id', $building_id);

        if ($request->filled('tenant_flat_office_no')) {
            $query->where('tenant_flat_office_no', $request->tenant_flat_office_no);
        }

        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('date', [$request->dateFrom, $request->dateTo]);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status === 'active' ? 1 : 0);
        }

        $security_data = $query->get();

        return view('building-admin.visitor-log.index', compact('tenants', 'security_data'));
    }

    public function store_tenant(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required',
            'tenantId' => 'required',
            'flat_office_number' => 'required',
            'sub_user' => 'required',
            'email' => 'required',
            'password' => 'required',
            'secretkey' => 'required',
            'name' => 'required',
            'contact' => 'nullable',
            'whatsup' => 'required',
            'emer_number' => 'required',
            'fromTime' => 'required',
            'toTime' => 'nullable',
            'tenantPhoto' => 'required|image|mimes:jpg,jpeg,png',
            'tenantIdProof' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $user = Auth::guard('buildingadmin')->user()->id;

        $building = Building_Master::find($user);

        $tenantCount = BuildingAdminTenant::where('building_id', $user)->count();

        if ($tenantCount >= $building->no_of_tenant) {
            return redirect()->back()->with('error', 'Tenant limit for this building has been reached.');
        }

        if ($request->hasFile('tenantPhoto')) {
            $file = $request->file('tenantPhoto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/images/');
            $tenantPhotoPath = $file->move($destinationPath, $filename);
        }

        if ($request->hasFile('tenantIdProof')) {
            $file = $request->file('tenantIdProof');
            $filename_1 = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/upload/');
            $tenantIdProofPath = $file->move($destinationPath, $filename_1);
        }

        $data = BuildingAdminTenant::create([
            'date' => $request->date,
            'tenant_id' => $request->tenantId,
            'flat_office_no' => $request->flat_office_number,
            'no_sub_user' => $request->sub_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'secret_key' => $request->secretkey,
            'contact_person' => $request->name,
            'contact_number' => $request->contact,
            'whatsapp_no' => $request->whatsup,
            'emergency_contact_no' => $request->emer_number,
            'visiting_hour_from' => $request->fromTime,
            'visiting_hour_to' => $request->toTime,
            'tenant_photo' => $filename,
            'tenant_id_proof' => $filename_1,
            'building_id' => $user,
            'added_by' => $user,
            'status' => 1,
        ]);

        return redirect()->route('building-admin.tenant-index')->with('success', 'Tenant created successfully.');

    }

    public function update_tenant(Request $request, $id)
    {

        // dd($request);
        $validatedData = $request->validate([
            'date' => 'required',
            'tenantId' => 'required',
            'flat_office_number' => 'required',
            'sub_user' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'secretkey' => 'required',
            'name' => 'required',
            'contact' => 'nullable',
            'whatsup' => 'required',
            'emer_number' => 'required',
            'fromTime' => 'required',
            'toTime' => 'required',
            'tenantPhoto' => 'nullable|image|mimes:jpg,jpeg,png',
            'tenantIdProof' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $tenant = BuildingAdminTenant::findOrFail($id);

        $user = Auth::guard('superadmin')->user()->id;

        // dd($user);

        $tenantPhotoPath = $tenant->tenant_photo;
        $tenantIdProofPath = $tenant->tenant_id_proof;

        if ($request->hasFile('tenantPhoto')) {
            $file = $request->file('tenantPhoto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/images/');
            $tenantPhotoPath = $file->move($destinationPath, $filename);
        }

        if ($request->hasFile('tenantIdProof')) {
            $file = $request->file('tenantIdProof');
            $filename_1 = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('assets/upload/');
            $tenantIdProofPath = $file->move($destinationPath, $filename_1);
        }

        $tenant->update([

            // dd($request),
            'date' => $request->date,
            'tenant_id' => $request->tenantId,
            'flat_office_no' => $request->flat_office_number,
            'no_sub_user' => $request->sub_user,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $tenant->password,
            'secret_key' => $request->secretkey,
            'contact_person' => $request->name,
            'contact_number' => $request->contact,
            'whatsapp_no' => $request->whatsup,
            'emergency_contact_no' => $request->emer_number,
            'visiting_hour_from' => $request->fromTime,
            'visiting_hour_to' => $request->toTime,
            'tenant_photo' => $tenantPhotoPath,
            'tenant_id_proof' => $tenantIdProofPath,
            'edited_by' => $user,
            'status' => 1,
        ]);

        return redirect()->route('building-admin.tenant-index')->with('success', 'Tenant updated successfully.');
    }

    public function status_tenant(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $data = BuildingAdminTenant::findOrFail($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

}