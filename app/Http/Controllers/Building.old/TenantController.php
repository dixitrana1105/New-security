<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TenantController extends Controller
{

    public function index_tenant()
    {
        return view('building-admin.tenant.index');
    }


    public function create_tenant()
    {
        return view('building-admin.tenant.create');
    }

    public function edit_tenant()
    {
        return view('building-admin.tenant.edit');
    }

    public function sub_tenant_index(){

        return view('building-admin.sub-tenant.index');
    }

    public function visitor_log_index() {
        return view('building-admin.visitor-log.index');
    }

    
}
