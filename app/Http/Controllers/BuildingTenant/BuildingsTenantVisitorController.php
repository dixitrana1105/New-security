<?php

namespace App\Http\Controllers\BuildingTenant;

use App\Http\Controllers\Controller;
use App\Models\BuildingAdminTenant;
use App\Models\TenantVisitor;
use App\Models\Visitor_Master;
use App\Services\BlockTenantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsTenantVisitorController extends Controller
{

    protected $blockTenantService;

    public function __construct(BlockTenantService $blockTenantService)
    {
        $this->blockTenantService = $blockTenantService;
    }

    public function index_visitor()
    {

        // dd('ok');

        $bulding_id = Auth::guard('buildingtenant')->user()->building_id;


        $flat_office_no = Auth::guard('buildingtenant')->user()->flat_office_no;


        $login_id = Auth::guard('buildingtenant')->user()->id;

        $match_subenant_id = BuildingAdminTenant::where('id', $login_id)->first('sub_tenant_id');


        if ($match_subenant_id->sub_tenant_id !== null) {
            return redirect()->route('building-sub-tenant.visitor-index');
        }

        $security_data = Visitor_Master::where('building_id', $bulding_id)
            ->where('tenant_flat_office_no', $flat_office_no)
            ->whereNull('out_time_remark')
            ->get();


        return view('building-tenant.visitor.index', compact('security_data'));
    }

    public function index_sub__tenant_visitor()
    {

        $bulding_id = Auth::guard('buildingtenant')->user()->building_id;

        // dd(Auth::guard('buildingtenant')->user());

        $flat_office_no = Auth::guard('buildingtenant')->user()->flat_office_no;

        // dd($flat_office_no);

        $login_id = Auth::guard('buildingtenant')->user()->id;

        $match_subenant_id = BuildingAdminTenant::where('id', $login_id)->first('sub_tenant_id');

        $security_data = Visitor_Master::where('building_id', $bulding_id)
            ->where('tenant_flat_office_no', $flat_office_no)
            ->whereNull('out_time_remark')
            ->get();

        // dd($match_subenant_id);

        //    $id_seb_tenant = sabkb;

        return view('building-sub-tenant.visitor.index', compact('security_data', 'match_subenant_id'));

    }

    public function create_visitor()
    {
        $building_id = Auth::guard('buildingtenant')->user()->building_id;

        $lastVisitor = TenantVisitor::where('visitor_id', 'like', 'TENA' . $building_id . '%')
            ->orderBy('visitor_id', 'desc')
            ->first();

        if ($lastVisitor) {
            $lastVisitorIdNumeric = (int) str_replace('TENA', '', $lastVisitor->visitor_id);
            $nextVisitorId = $lastVisitorIdNumeric + 1;
        } else {
            $nextVisitorId = $building_id * 1000 + 1;
        }

        $nextVisitorId = 'TENA' . $nextVisitorId;

        $tenants = Auth::guard('buildingtenant')->user()->flat_office_no;

        return view('building-tenant.visitor.create', compact('tenants', 'nextVisitorId'));
    }

    public function visitor_store(Request $request)
    {

        // dd($request);
        $request->validate([
            'tenant_flat_office_no' => 'required',
            'VisitorId' => 'required',
            'date' => 'required',
            'full_name' => 'required',
            'in_time' => 'required',
            'out_time' => '',
            'visiter_purpose' => 'required',
            'photo' => 'required|image',
        ]);

        $photoPath = null;
        // $id_proofPath = null;

        if ($request->hasFile('photo')) {
            $destinationPath = public_path('assets/images/');
            $photoFileName = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move($destinationPath, $photoFileName);
            $photoPath = 'assets/images/' . $photoFileName;
        }

        // Handle ID proof upload
        // if ($request->hasFile('id_proof')) {
        //     $destinationPath = public_path('assets/images/');
        //     $id_proofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
        //     $request->file('id_proof')->move($destinationPath, $id_proofFileName);
        //     $id_proofPath = 'assets/images/' . $id_proofFileName;
        // }

        // dd(Auth::guard('buildingtenant')->user()->building_id);
        // Store visitor data
        $data = new TenantVisitor();
        $data->tenant_flat_office_no = $request->tenant_flat_office_no;
        $data->visitor_id = $request->VisitorId;
        $data->date = $request->date;
        $data->full_name = $request->full_name;
        $data->in_time = $request->in_time;
        $data->out_time = $request->out_time;
        $data->visiter_purpose = $request->visiter_purpose;
        $data->building_id = Auth::guard('buildingtenant')->user()->building_id;
        $data->status = 1;
        $data->photo = $photoPath;
        // $data->id_proof = $id_proofPath;
        $data->added_by = Auth::guard('buildingtenant')->user()->id;
        $data->created_at = now(); // Use Laravel's now() helper

        // Save the data
        $data->save();

        return redirect()->back()->with('success', 'Visitor added successfully');
    }

    public function status_visitor($id)
    {
        $data = TenantVisitor::find($id);

        // dd($data);

        // Toggle status between 0 and 1
        $data->status = ($data->status == 1) ? 0 : 1;

        $data->save();

        return redirect()->back()->with('success', 'Visitor status changed successfully');
    }

    public function timeoutRemark(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'out_time_remark' => 'required',
            'security_id' => 'required',
        ]);

        $securityId = $request->input('security_id');
        $remark = $request->input('out_time_remark');

        $security = TenantVisitor::find($securityId);
        if ($security) {
            $security->out_time_remark = $remark;
            $security->out_time = Carbon::now('Asia/Kolkata')->format('H:i');
            $security->save();
        }

        return redirect()->back()->with('success', 'Remark added successfully!');
    }

    public function blockTenant(Request $request)
    {
        $response = $this->blockTenantService->blockTenant($request);

        return response()->json($response);

    }

    public function saveAction(Request $request)
    {

        $response = $this->blockTenantService->saveActionforTenant($request);

        return response()->json($response);

    }

    public function index_visitor_for_add_tenant()
    {

        $bulding_id = Auth::guard('buildingtenant')->user()->building_id;

        $security_data = TenantVisitor::where('building_id', $bulding_id)
            ->get();

            return view('building-tenant.visitor.pre-approve-index', compact('security_data'));
        }

}
