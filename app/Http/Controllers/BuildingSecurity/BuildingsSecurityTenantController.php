<?php

namespace App\Http\Controllers\BuildingSecurity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuildingAdminTenant;


class BuildingsSecurityTenantController extends Controller
{
    public function index_tenant()
    {
        $buildingAdminId = Auth::guard('buildingSecutityadmin')->user()->id;    
        $bulding_id = Auth::guard('buildingSecutityadmin')->user()->building_id;
        
        // dd($bulding_id);

        // dd($buildingAdminId);
        $tenant_data = BuildingAdminTenant::whereNull('sub_tenant_id')->where('building_id', $bulding_id)->where('status', 1)->get();

        // dd($security_data);
        return view('building-security.tenant.index', compact('tenant_data'));
    }

}
