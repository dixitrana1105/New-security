<?php
namespace App\Http\Controllers\BuildingTenant;

use App\Http\Controllers\Controller;
use App\Models\BlockVisitor;
use App\Models\BuildingAdminTenant;
use App\Models\BuildingAdminTicket;
use App\Models\BuildingSecurityTicket;
use App\Models\BuildingTenantTicket;
use App\Models\Visitor_Master;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsTenantController extends Controller
{
    public function dashboard()
    {
        $id = Auth::guard('buildingtenant')->user()->id;

        // dd($id);

        $match_subenant_id = BuildingAdminTenant::where('id', $id)->first('sub_tenant_id');

        // dd($match_subenant_id->sub_tenant_id);

        if ($match_subenant_id->sub_tenant_id !== null) {
            // $this->is_not_null_deshboard();
            return redirect()->route('building-sub-tenant.dashboard');
        }

        $currentTime  = Carbon::now()->format('H:i:s');
        $currentDate  = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $startOfWeek  = Carbon::now()->startOfWeek();
        $endOfWeek    = Carbon::now()->endOfWeek();

        $added_id = BuildingAdminTenant::where('id', $id)->value('added_by');

        $currentvisitorCount = Visitor_Master::where('added_by', $added_id)
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

        $sub_tenant = BuildingAdminTenant::where('added_by', $added_id)->whereNotNull('sub_tenant_id')
            ->count();

        // $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 0)->get();
        // $get_all_ticket_from_security = BuildingSecurityTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 0)->get();
        // { $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 1)->get();
        //     $get_all_ticket_from_security = BuildingSecurityTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 1)->get();
        //     $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 2)->get();
        //     $get_all_ticket_from_security = BuildingSecurityTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 2)->get();

        //     $Myticket = BuildingTenantTicket::where('added_by', Auth::guard('buildingtenant')
        //     ->user()->id)

        //     ->get()
        //     ->sortByDesc('created_at');

        // Count BuildingAdminTicket statuses
        $Buildingnew = BuildingAdminTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', null)->count();
        $BuildingTenantnew = BuildingTenantTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', null)->count();

        $adminOpen  = BuildingAdminTicket::where('role', 'building_tenant')->where('status_of_button', 0)->count();
        $adminHold  = BuildingAdminTicket::where('role', 'building_tenant')->where('status_of_button', 1)->count();
        $adminClose = BuildingAdminTicket::where('role', 'building_tenant')->where('status_of_button', 2)->count();

        $securityOpen  = BuildingSecurityTicket::where('role', 'building_tenant')->where('status_of_button', 0)->count();
        $securityHold  = BuildingSecurityTicket::where('role', 'building_tenant')->where('status_of_button', 1)->count();
        $securityClose = BuildingSecurityTicket::where('role', 'building_tenant')->where('status_of_button', 2)->count();

        $myTicketCount = BuildingTenantTicket::where('added_by', Auth::guard('buildingtenant')->user()->id)->count();

        $totalTickets = $adminOpen + $adminHold + $adminClose +
            $securityOpen + $securityHold + $securityClose +
            $myTicketCount + $Buildingnew + $BuildingTenantnew ;

        $data = [
            'Open'          => $adminOpen + $securityOpen,
            'Hold'          => $adminHold + $securityHold,
            'Close'         => $adminClose + $securityClose,
            'New' => $BuildingTenantnew + $Buildingnew,
            'My Tickets'    => $myTicketCount,
            'Total Tickets' => $totalTickets,
        ];

        // dd($data);


        return view('building-tenant.dashboard', compact('currentvisitorCount', 'todayvisitorCount', 'monthlyvisitor', 'weeklyvisitor',
            'blocked_visitor', 'sub_tenant', 'data'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'      => 'required|email',
            'password'   => 'required',
            'secret_key' => 'required',
        ]);

        if (Auth::guard('buildingtenant')->attempt([
            'email'      => $request->email,
            'password'   => $request->password,
            'secret_key' => $request->secret_key,
        ])) {
            return redirect()->route('building-tenant.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function is_not_null_deshboard()
    {
        $id = Auth::guard('buildingtenant')->user()->id;

        // dd($id);

        $match_subenant_id = BuildingAdminTenant::where('id', $id)->first('sub_tenant_id');

        // dd($match_subenant_id->sub_tenant_id);

        // if ($match_subenant_id->sub_tenant_id !== null) {
        //     $this->is_not_null_deshboard();
        //     // return redirect()->route('building-sub-tenant.dashboard');
        // }

        $currentTime  = Carbon::now()->format('H:i:s');
        $currentDate  = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $startOfWeek  = Carbon::now()->startOfWeek();
        $endOfWeek    = Carbon::now()->endOfWeek();

        $added_id = BuildingAdminTenant::where('id', $id)->value('added_by');

        $currentvisitorCount = Visitor_Master::where('added_by', $added_id)
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

        $sub_tenant = BuildingAdminTenant::where('added_by', $added_id)->whereNotNull('sub_tenant_id')
            ->count();

        return view('building-tenant.dashboard', compact('currentvisitorCount', 'todayvisitorCount', 'monthlyvisitor', 'weeklyvisitor',
            'blocked_visitor', 'sub_tenant'));
    }
}
