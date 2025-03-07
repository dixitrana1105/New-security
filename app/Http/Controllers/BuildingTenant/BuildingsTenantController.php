<?php

namespace App\Http\Controllers\BuildingTenant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuildingAdminTenant;
use App\Models\BlockVisitor;
use App\Models\Security_Master;
use App\Models\Visitor_Master;
use Carbon\Carbon;

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


        $currentTime = Carbon::now()->format('H:i:s');
        $currentDate = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

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

        $blocked_visitor = BlockVisitor::where('added_by',$id)
            ->count();

        $sub_tenant = BuildingAdminTenant::where('added_by',$added_id)->whereNotNull('sub_tenant_id')
            ->count();

        return view('building-tenant.dashboard',compact('currentvisitorCount','todayvisitorCount','monthlyvisitor','weeklyvisitor',
        'blocked_visitor','sub_tenant'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'secret_key' => 'required',
        ]);


        if (Auth::guard('buildingtenant')->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'secret_key' => $request->secret_key
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


        $currentTime = Carbon::now()->format('H:i:s');
        $currentDate = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

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

        $blocked_visitor = BlockVisitor::where('added_by',$id)
            ->count();

        $sub_tenant = BuildingAdminTenant::where('added_by',$added_id)->whereNotNull('sub_tenant_id')
            ->count();


        return view('building-tenant.dashboard',compact('currentvisitorCount','todayvisitorCount','monthlyvisitor','weeklyvisitor',
        'blocked_visitor','sub_tenant'));
    }
}
