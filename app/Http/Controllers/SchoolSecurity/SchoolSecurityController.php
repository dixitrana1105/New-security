<?php

namespace App\Http\Controllers\SchoolSecurity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SchoolSecurityVisitor;
use App\Models\SchoolSecurityTicket;
use Carbon\Carbon;
use App\Models\SchoolAdminSecurity;

class SchoolSecurityController extends Controller
{
    public function dashboard()
    {
        $id = Auth::guard('schoolsecurity')->user()->id;
        $currentTime = Carbon::now()->format('H:i:s');
        $currentDate = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $currentvisitorCount = SchoolSecurityVisitor::where('added_by', $id)
            ->whereDate('date', Carbon::today())
            ->where(function ($query) use ($currentTime) {
                $query->whereNull('out_time')
                    ->orWhere('out_time', '>', $currentTime);
            })
            ->count();

        $todayvisitorCount = SchoolSecurityVisitor::where('added_by', $id)
            ->whereDate('date', $currentDate)
            ->count();

        $relatedsecurity = SchoolAdminSecurity::where('id', $id)->pluck('added_by')->first();
        $totalsecurityCounter = SchoolAdminSecurity::where('added_by', $relatedsecurity)
            ->count();

        $monthlyvisitor = SchoolSecurityVisitor::where('added_by', $id)
            ->whereMonth('date', $currentMonth)
            ->count();

        $weeklyvisitor = SchoolSecurityVisitor::where('added_by', $id)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->count();

            $CountOfnewTicket = SchoolSecurityTicket::where('added_by', Auth::guard('schoolsecurity')
            ->user()->id)
->count();
// dd($CountOfnewTicket);











        return view('school-security.dashboard', compact('currentvisitorCount','todayvisitorCount','totalsecurityCounter',
        'monthlyvisitor','weeklyvisitor', 'CountOfnewTicket'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'secret_key' => 'required',
        ]);


        if (Auth::guard('schoolsecurity')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'secret_key' => $request->secret_key
        ])) {
            return redirect()->route('school.security.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }
}
