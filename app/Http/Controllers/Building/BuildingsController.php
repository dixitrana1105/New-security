<?php
namespace App\Http\Controllers\Building;

use App\Http\Controllers\Controller;
use App\Models\BuildingAdminTenant;
use App\Models\BuildingAdminTicket;
use App\Models\BuildingSecurityTicket;
use App\Models\BuildingTenantTicket;
use App\Models\Security_Master;
use App\Models\Visitor_Master;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsController extends Controller
{

    public function dashboard()
    {
        $id           = Auth::guard('buildingadmin')->user()->id;
        $currentTime  = Carbon::now()->format('H:i:s');
        $currentDate  = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $startOfWeek  = Carbon::now()->startOfWeek();
        $endOfWeek    = Carbon::now()->endOfWeek();
        $security_ids = Security_Master::where('added_by', $id)->pluck('id');

        $total_tenant = BuildingAdminTenant::where('added_by', $id)->whereNull('sub_tenant_id')
            ->count();

        $inactive_tenant = BuildingAdminTenant::where('added_by', $id)->whereNull('sub_tenant_id')
            ->where('status', 0)
            ->count();

        $total_security = Security_Master::where('added_by', $id)
            ->count();

        $sub_tenant = BuildingAdminTenant::where('added_by', $id)->whereNotNull('sub_tenant_id')
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
        // Count tickets from BuildingTenantTicket
        // Count tickets from BuildingTenantTicket
        $tenant_new   = BuildingTenantTicket::where('role', 'building_admin')->whereNull('status_of_button')->count();
        $tenant_open  = BuildingTenantTicket::where('role', 'building_admin')->where('status_of_button', 0)->count();
        $tenant_hold  = BuildingTenantTicket::where('role', 'building_admin')->where('status_of_button', 1)->count();
        $tenant_close = BuildingTenantTicket::where('role', 'building_admin')->where('status_of_button', 2)->count();

// Count tickets from BuildingSecurityTicket
        $security_new   = BuildingSecurityTicket::where('role', 'building_admin')->whereNull('status_of_button')->count();
        $security_open  = BuildingSecurityTicket::where('role', 'building_admin')->where('status_of_button', 0)->count();
        $security_hold  = BuildingSecurityTicket::where('role', 'building_admin')->where('status_of_button', 1)->count();
        $security_close = BuildingSecurityTicket::where('role', 'building_admin')->where('status_of_button', 2)->count();

// Sum up counts for all statuses
        $total_new   = $tenant_new + $security_new;
        $total_open  = $tenant_open + $security_open;
        $total_hold  = $tenant_hold + $security_hold;
        $total_close = $tenant_close + $security_close;

// Count BuildingAdminTicket
        $my_ticket_count = BuildingAdminTicket::where('added_by', Auth::guard('buildingadmin')->user()->id)->count();

// Now calculate total tickets after defining all totals
        $total_tickets = $total_new + $total_open + $total_hold + $total_close + $my_ticket_count;

// Display results
        $data = [
            'New'           => $total_new,
            'Open'          => $total_open,
            'Hold'          => $total_hold,
            'Close'         => $total_close,
            'My Tickets'    => $my_ticket_count,
            'total_tickets' => $total_tickets,
        ];

        // dd($data);

        return view('building.dashboard', compact('total_tenant', 'inactive_tenant', 'total_security', 'sub_tenant',
            'currentvisitorCount', 'todayvisitorCount', 'monthlyvisitor', 'weeklyvisitor', 'data'));
    }

    public function login(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'email'      => 'required',
            'password'   => 'required',
            'secret_key' => 'required',
        ]);

        if (Auth::guard('buildingadmin')->attempt([

            'email'      => $request->email,
            'password'   => $request->password,
            'secret_key' => $request->secret_key,
            'type'       => 'building',

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
            'email'      => 'required',
            'password'   => 'required',
            'secret_key' => 'required',
        ]);

        if (Auth::guard('buildingSecutityadmin')->attempt([

            'email'      => $request->email,
            'password'   => $request->password,
            'secret_key' => $request->secret_key,

        ])) {

            return redirect()->route('building-security.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

}
