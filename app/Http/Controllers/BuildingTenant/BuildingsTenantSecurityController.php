<?php

namespace App\Http\Controllers\BuildingTenant;

use App\Http\Controllers\Controller;
use App\Models\BuildingAdminTenant;
use App\Models\Visitor_Master;

use App\Models\Security_Master;
use App\Models\TenantVisitor;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BuildingsTenantSecurityController extends Controller
{
    public function index_security()
    {
        $buildingAdminId = Auth::guard('buildingtenant')->user()->id;    
        $bulding_id = Auth::guard('buildingtenant')->user()->building_id;
      
        $security_data = Security_Master::where('building_id', $bulding_id)->where('status', 1)->get();


        return view('building-tenant.security.index', compact('security_data'));
    }

    public function index_visitor_log(Request $request)
    {

        $building_id = Auth::guard('buildingtenant')->user()->building_id;

        $tenants = TenantVisitor::
            where('building_id', $building_id)
            ->get();

        $query = TenantVisitor::whereNotNull('out_time_remark')->where('building_id', $building_id);

       

        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('date', [$request->dateFrom, $request->dateTo]);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status === 'active' ? 1 : 0);
        }

        $security_data = $query->get();

        // dd($security_data);

        return view('building-tenant.visitor-log.index', compact('security_data', 'tenants'));
    }

    public function index_sub_tenant(Request $request)
    {
        $filter = $request->input('subtenant');

        $tenant_id = Auth::guard('buildingtenant')->user()->tenant_id;
        $sub_tenant_filter = BuildingAdminTenant::select('id', 'contact_person')->where('tenant_id', $tenant_id)->whereNotNull('sub_tenant_id')->get();

        $query = BuildingAdminTenant::where('tenant_id', $tenant_id)->whereNotNull('sub_tenant_id');

        if ($filter !== null) {
            $query->where('id', $filter);
        }

        $sub_tenant = $query->get();

        return view('building-tenant.sub-tenant.index', compact('sub_tenant', 'sub_tenant_filter'));
    }

    public function create_sub_tenant()
    {
        $id = Auth::guard('buildingtenant')->user()->id;

        $subTenantID = BuildingAdminTenant::latest('sub_tenant_id')->first();

        $subTenantID = BuildingAdminTenant::latest('sub_tenant_id')->first();

        if ($subTenantID && is_numeric($subTenantID->sub_tenant_id)) {
            $lastId = intval($subTenantID->sub_tenant_id);
            $nextId = str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nextId = '444444';
        }

        $tenant = BuildingAdminTenant::where('id', $id)->first();

        return view('building-tenant.sub-tenant.create', compact('tenant', 'nextId'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sub_tenant_id' => 'required',
            'tenantId' => 'required',
            'email' => 'required|email|unique:building_tenant,email',
            'password' => 'required',
            'secret_key' => 'required',
            'sub_tenant_name' => 'required',
            'sub_tenant_contact_number' => 'nullable',
            'sub_tenant_whatsapp_number' => 'required',
            'emergency_contact_no' => 'required',
            'visiting_hour_from' => 'required',
            'visiting_hour_to' => 'required',
            'flat_office_number' => 'required',
        ]);

        $user = Auth::guard('buildingtenant')->user()->id;

        $tenant_building = BuildingAdminTenant::find($user);

        $sub_tenantCount = BuildingAdminTenant::where('added_by', $user)->count();

        if ($sub_tenantCount >= $tenant_building->no_sub_user) {
            return redirect()->back()->with('error', 'Sub Tenant limit for this tenant has been reached.');
        }

        $data = BuildingAdminTenant::create([
            'tenant_id' => $request->tenantId,
            'sub_tenant_id' => $request->sub_tenant_id,
            'flat_office_no' => $request->flat_office_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'secret_key' => $request->secret_key,
            'contact_person' => $request->sub_tenant_name,
            'contact_number' => $request->sub_tenant_contact_number,
            'whatsapp_no' => $request->sub_tenant_whatsapp_number,
            'emergency_contact_no' => $request->emergency_contact_no,
            'visiting_hour_from' => $request->visiting_hour_from,
            'visiting_hour_to' => $request->visiting_hour_to,
            'building_id' => $request->building_id,
            'added_by' => $user,
            'status' => 1,
        ]);

        return redirect()->route('building-tenant.sub-tenant')->with('success', 'Sub Tenant created successfully.');
    }

    public function sub_tenant_status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $data = BuildingAdminTenant::findOrFail($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }



    public function show_security($id){


        $security = \App\Models\Security_Master::find($id);

    // Fetch country, state, and city data
    $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
    $states = State::select('id', 'name', 'country_id')->get();
    $cities = City::select('id', 'name', 'state_id')->get();

    if (!$security) {
        return redirect()->back()->with('error', 'Security entry not found or unauthorized');
    }

    // Pass the data to the view
    return view('building-tenant.security.show', compact('security', 'country', 'states', 'cities'));
    }
}
