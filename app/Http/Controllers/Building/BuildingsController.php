<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuildingAdminTenant;
use App\Models\Security_Master;
use App\Models\Visitor_Master;
use App\Models\BlockVisitor;
use App\Models\Building_Master;
use Carbon\Carbon;

class BuildingsController extends Controller
{

    public function dashboard()
    {
        $id = Auth::guard('buildingadmin')->user()->id;
        $currentTime = Carbon::now()->format('H:i:s');
        $currentDate = Carbon::now();
        $currentMonth = Carbon::now()->month;  
        $startOfWeek = Carbon::now()->startOfWeek(); 
        $endOfWeek = Carbon::now()->endOfWeek();
        $security_ids = Security_Master::where('added_by',$id)->pluck('id');

        $total_tenant = BuildingAdminTenant::where('added_by',$id)->whereNull('sub_tenant_id')        
        ->count();

        $inactive_tenant = BuildingAdminTenant::where('added_by',$id)->whereNull('sub_tenant_id')
        ->where('status', 0)
        ->count();

        $total_security = Security_Master::where('added_by',$id)
        ->count();

        $sub_tenant = BuildingAdminTenant::where('added_by',$id)->whereNotNull('sub_tenant_id')        
        ->count();

        $currentvisitorCount = Visitor_Master::whereIn('added_by', $security_ids)
            ->whereDate('date', Carbon::today())
            ->where(function ($query) use ($currentTime) {
                $query->whereNull('out_time')
                    ->orWhere('out_time', '>', $currentTime);
            })
            ->count(); 

        $todayvisitorCount = Visitor_Master::whereIn('added_by', $security_ids)
            ->whereDate('date', $currentDate)
            ->count();

        $monthlyvisitor = Visitor_Master::whereIn('added_by', $security_ids)
            ->whereMonth('date', $currentMonth)
            ->count();

        $weeklyvisitor = Visitor_Master::whereIn('added_by', $security_ids)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->count();
          
        // $blocked_visitor = BlockVisitor::where('added_by',$security_ids)
        //     ->count();    

        return view('building.dashboard',compact('total_tenant','inactive_tenant','total_security','sub_tenant',
        'currentvisitorCount','todayvisitorCount','monthlyvisitor','weeklyvisitor'));
    }

    public function login(Request $request)
    {    
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'secret_key' => 'required',
        ]);

        if (Auth::guard('buildingadmin')->attempt([

            'email' => $request->email,
            'password' => $request->password,
            'secret_key' => $request->secret_key,
            'type' => 'building'

        ])) {
            return redirect()->route('building.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function bulding_secutity(Request $request)
    {     

        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'secret_key' => 'required',
        ]);

        if (Auth::guard('buildingSecutityadmin')->attempt([

            'email' => $request->email,
            'password' => $request->password,
            'secret_key' => $request->secret_key,

        ])) {

            return redirect()->route('building-security.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }



}
