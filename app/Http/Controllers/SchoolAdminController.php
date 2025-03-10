<?php
namespace App\Http\Controllers;

use App\Models\SchoolAdminSecurity;
use App\Models\SchoolSecurityTicket;
use App\Models\SchoolSecurityVisitor;
use App\Models\SchoolAdminTicket;
use App\Models\SuperAdminTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolAdminController extends Controller
{
    public function dashboard()
    {
        $id           = Auth::guard('buildingadmin')->user()->id;
        $currentTime  = Carbon::now()->format('H:i:s');
        $currentDate  = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $startOfWeek  = Carbon::now()->startOfWeek();
        $endOfWeek    = Carbon::now()->endOfWeek();
        $security_ids = SchoolAdminSecurity::where('added_by', $id)->pluck('id');

        $currentvisitorCount = SchoolSecurityVisitor::whereIn('added_by', $security_ids)
            ->whereDate('date', Carbon::today())
            ->where(function ($query) use ($currentTime) {
                $query->whereNull('out_time')
                    ->orWhere('out_time', '>', $currentTime);
            })
            ->count();

        $todayvisitorCount = SchoolSecurityVisitor::whereIn('added_by', $security_ids)
            ->whereDate('date', $currentDate)
            ->count();

        $monthlyvisitor = SchoolSecurityVisitor::whereIn('added_by', $security_ids)
            ->whereMonth('date', $currentMonth)
            ->count();

        $weeklyvisitor = SchoolSecurityVisitor::whereIn('added_by', $security_ids)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->count();

        $totalsecurityCounter = SchoolAdminSecurity::where('added_by', $id)
            ->count();



        $schoolSecurityOpen  = SchoolSecurityTicket::where('role', 'school_admin')->where('status_of_button', 0)->count();
        $schoolSecurityHold  = SchoolSecurityTicket::where('role', 'school_admin')->where('status_of_button', 1)->count();
        $schoolSecurityClose = SchoolSecurityTicket::where('role', 'school_admin')->where('status_of_button', 2)->count();
        $schoolSecurityNull  = SchoolSecurityTicket::where('role', 'school_admin')->whereNull('status_of_button')->count();

        $superAdminOpen  = SuperAdminTicket::where('role', 'school_admin')->where('status_of_button', 0)->count();
        $superAdminHold  = SuperAdminTicket::where('role', 'school_admin')->where('status_of_button', 1)->count();
        $superAdminClose = SuperAdminTicket::where('role', 'school_admin')->where('status_of_button', 2)->count();
        $superAdminNull  = SuperAdminTicket::where('role', 'school_admin')->whereNull('status_of_button')->count();

        $schoolAdminTicketCount = SchoolAdminTicket::where('added_by', Auth::guard('buildingadmin')->user()->id)->count();

        $totalTickets = $schoolSecurityOpen + $schoolSecurityHold + $schoolSecurityClose + $schoolSecurityNull +
            $superAdminOpen + $superAdminHold + $superAdminClose + $superAdminNull +
            $schoolAdminTicketCount;

        $data = [
            'Open'                 => $schoolSecurityOpen + $superAdminOpen,
            'Hold'                 => $schoolSecurityHold + $superAdminHold,
            'Close'                => $schoolSecurityClose + $superAdminClose,
            'New'                 => $schoolSecurityNull + $superAdminNull,
            'School Admin Tickets' => $schoolAdminTicketCount,
            'Total Tickets'        => $totalTickets,
        ];

        // dd( $data['Open']);

        return view('school-admin.dashboard', compact('currentvisitorCount', 'todayvisitorCount', 'totalsecurityCounter',
            'monthlyvisitor', 'weeklyvisitor', 'data' ));
    }

    public function visitor_log(Request $request)
    {
        $school_id = Auth::guard('buildingadmin')->user()->id;
        $status    = $request->input('status');

        $security_ids = SchoolAdminSecurity::where('added_by', $school_id)->pluck('id')->toArray();

        $query = SchoolSecurityVisitor::whereIn('added_by', $security_ids);

        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('date', [$request->dateFrom, $request->dateTo]);
        }

        if ($status !== null) {
            $query->where('status', $status);
        }

        $security_data = $query->get();

        return view('school-admin.visitor-log.index', compact('security_data'));
    }

    // public function visitor_log(Request $request)
    // {
    //     $building_id = Auth::guard('buildingadmin')->user()->id;
    //     $tenants = Visitor_Master::
    //     where('building_id', $building_id)
    //     ->get();
    //     $query = Visitor_Master::where('building_id', $building_id);

    //     if ($request->filled('tenant_id')) {
    //         $query->where('    tenant_id', $request->tenant_id);
    //     }

    //     if ($request->filled('dateFrom') && $request->filled('dateTo')) {
    // $query->whereBetween('date', [$request->dateFrom, $request->dateTo]);
    //     }

    //     if ($request->filled('status') && $request->status !== 'all') {
    //             $query->where('status', $request->status === 'active' ? 1 : 0);
    //     }

    //     $security_data = $query->get();

    //     return view('school-admin.visitor-l    og.index', compact('security_data', 'tenants'));
    // }

    public function login(Request $request)
    {

        $request->validate([
            'email'      => 'required|email',
            'password'   => 'required',
            'secret_key' => 'required',
        ]);

        if (Auth::guard('buildingadmin')->attempt([
            'email'      => $request->email,
            'password'   => $request->password,
            'secret_key' => $request->secret_key,
            'type'       => 'school',
        ])) {
            return redirect()->route('school.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
}
