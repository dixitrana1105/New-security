<?php
namespace App\Http\Controllers\BuildingSecurity;

use App\Http\Controllers\Controller;
use App\Models\BlockVisitor;
use App\Models\BuildingAdminTenant;
use App\Models\BuildingAdminTicket;
use App\Models\SchoolAdminTicket;
use App\Models\BuildingTenantTicket;
use App\Models\BuildingSecurityTicket;
use App\Models\Security_Master;
use App\Models\Visitor_Master;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsSecurityController extends Controller
{
    public function dashboard()
    {
        $id           = Auth::guard('buildingSecutityadmin')->user()->id;
        $currentTime  = Carbon::now()->format('H:i:s');
        $currentDate  = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $startOfWeek  = Carbon::now()->startOfWeek();
        $endOfWeek    = Carbon::now()->endOfWeek();

        $added_id = Security_Master::where('id', $id)->value('added_by');

        $total_tenant = BuildingAdminTenant::where('added_by', $added_id)->whereNull('sub_tenant_id')
            ->count();

        $inactive_tenant = BuildingAdminTenant::where('added_by', $added_id)->whereNull('sub_tenant_id')
            ->where('status', 0)
            ->count();

        $sub_tenant = BuildingAdminTenant::where('added_by', $added_id)->whereNotNull('sub_tenant_id')
            ->count();

        $total_security = Security_Master::where('added_by', $added_id)
            ->count();

        $currentvisitorCount = Visitor_Master::where('added_by', $id)
            ->whereDate('date', Carbon::today())
            ->where(function ($query) use ($currentTime) {
                $query->whereNull('out_time')
                    ->orWhere('out_time', '>', $currentTime);
            })
            ->count();

        $todayvisitorCount = Visitor_Master::where('added_by', $id)
            ->whereDate('date', $currentDate)
            ->count();

        $monthlyvisitor = Visitor_Master::where('added_by', $id)
            ->whereMonth('date', $currentMonth)
            ->count();

        $weeklyvisitor = Visitor_Master::where('added_by', $id)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->count();

        $blocked_visitor = BlockVisitor::where('added_by', $id)
            ->count();

        // Count tickets with status = NULL (New)
        $new_tickets = BuildingAdminTicket::where('role', 'building_security')->whereNull('status_of_button')->count() +
        SchoolAdminTicket::where('role', 'security')->whereNull('status_of_button')->count() +
        BuildingTenantTicket::where('role', 'security')->whereNull('status_of_button')->count();

// Count tickets with status = 0 (Open)
        $open_tickets = BuildingAdminTicket::where('role', 'building_security')->where('status_of_button', 0)->count() +
        SchoolAdminTicket::where('role', 'security')->where('status_of_button', 0)->count() +
        BuildingTenantTicket::where('role', 'security')->where('status_of_button', 0)->count();

// Count tickets with status = 1 (Hold)
        $hold_tickets = BuildingAdminTicket::where('role', 'building_security')->where('status_of_button', 1)->count() +
        SchoolAdminTicket::where('role', 'security')->where('status_of_button', 1)->count() +
        BuildingTenantTicket::where('role', 'security')->where('status_of_button', 1)->count();

// Count tickets with status = 2 (Close)
        $close_tickets = BuildingAdminTicket::where('role', 'building_security')->where('status_of_button', 2)->count() +
        SchoolAdminTicket::where('role', 'security')->where('status_of_button', 2)->count() +
        BuildingTenantTicket::where('role', 'security')->where('status_of_button', 2)->count();

// Count all security tickets
        $my_tickets = BuildingSecurityTicket::count();

// Display results
        $data = [
            'new_tickets'   => $new_tickets,
            'open_tickets'  => $open_tickets,
            'hold_tickets'  => $hold_tickets,
            'close_tickets' => $close_tickets,
            'my_tickets'    => $my_tickets,
            'total_tickets' => $new_tickets + $open_tickets + $hold_tickets + $close_tickets + $my_tickets,
        ];

        // dd($data);

        return view('building-security.dashboard', compact('total_tenant', 'inactive_tenant', 'sub_tenant', 'total_security',
            'currentvisitorCount', 'todayvisitorCount', 'monthlyvisitor', 'weeklyvisitor', 'blocked_visitor', 'data'));
    }

    public function login_building_security(Request $request)
    {
        // dd('ok');
        $request->validate([
            'email'      => 'required|email',
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
