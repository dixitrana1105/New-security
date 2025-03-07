<?php

namespace App\Http\Controllers\BuildingSecurity;

use App\Http\Controllers\Controller;
use App\Models\BuildingAdminTenant;
use App\Models\City;
use App\Models\Country;
use App\Models\Security_Master;
use App\Models\State;
use App\Models\Visitor_Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsSecuritySecController extends Controller
{
    public function index_security()
    {
        $buildingAdminId = Auth::guard('buildingSecutityadmin')->user()->id;
        $bulding_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

        // dd($bulding_id);

        // dd($buildingAdminId);
        $security_data = Security_Master::where('building_id', $bulding_id)->where('status', 1)->get();

        return view('building-security.security.index', compact('security_data'));
    }

    public function show_security($id)
    {
        // Fetch the specific security record by ID
        $security = \App\Models\Security_Master::find($id);

        // Fetch country, state, and city data
        $country = Country::where('status', 1)->select('name', 'id', 'code')->get();
        $states = State::select('id', 'name', 'country_id')->get();
        $cities = City::select('id', 'name', 'state_id')->get();

        if (! $security) {
            return redirect()->back()->with('error', 'Security entry not found or unauthorized');
        }

        // Pass the data to the view
        return view('building-security.security.show', compact('security', 'country', 'states', 'cities'));
    }

    public function index_visitor_log(Request $request)
    {
        $building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

        $tenants = Visitor_Master::where('building_id', $building_id)
            ->get();

        $query = Visitor_Master::whereNotNull('out_time_remark')->where('building_id', $building_id);

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

        return view('building-security.visitor-log.index', compact('security_data', 'tenants'));
    }

    public function index_sub_tenant()
    {
        $buildingAdminId = Auth::guard('buildingSecutityadmin')->user()->id;
        $building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

        // dd($bulding_id);

        // dd($buildingAdminId);
        $tenant_data = BuildingAdminTenant::whereNotNull('sub_tenant_id')
            ->where('building_id', $building_id)
            ->where('status', 1)
            ->get();

        // dd($tenant_data);

        return view('building-security.sub-tenant.index', compact('tenant_data'));
    }
}
