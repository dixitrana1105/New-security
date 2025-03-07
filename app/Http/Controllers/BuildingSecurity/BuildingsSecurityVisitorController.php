<?php

namespace App\Http\Controllers\BuildingSecurity;

use App\Http\Controllers\Controller;
use App\Models\BlockVisitor;
use App\Models\BuildingAdminTenant;
use App\Models\TenantVisitor;
use App\Models\Visitor_Master;
use App\Models\Visitor;
use App\Services\BlockTenantService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuildingsSecurityVisitorController extends Controller
{

    protected $blockTenantService;

    public function __construct(BlockTenantService $blockTenantService)
    {
        $this->blockTenantService = $blockTenantService;
    }

    public function index_visitor()
    {

        $bulding_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

        $security_data = Visitor_Master::where('building_id', $bulding_id)
            ->whereNull('out_time_remark')
            ->get();

        return view('building-security.visitor.index', compact('security_data'));
    }

    public function create_visitor(Request $request)
    {
        $visitorData = $request->only(['visitor_id', 'is_new_visitor', 'building_type']);

        // dd($visitorData);
        $visitor_id = $request->visitor_id;
        // dd($visitor_id);
        $building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

        $lastVisitor = Visitor_Master::where('visitor_id', 'like', $building_id . '%')
            ->orderBy('visitor_id', 'desc')
            ->first();

        if ($lastVisitor) {
            $nextVisitorId = (int) $lastVisitor->visitor_id + 1;
        } else {
            $nextVisitorId = $building_id * 1000 + 1;
        }

        $tenants = BuildingAdminTenant::whereNull('sub_tenant_id')
            ->whereNotNull('flat_office_no')
            ->where('building_id', $building_id)
            ->get();

            $base64Image = $request->query('capturedPreview'); // Assume this is a base64 string
        if ($base64Image) {
            list($type, $base64Data) = explode(';', $base64Image);
            list(, $base64Data) = explode(',', $base64Data);
            $imageData = base64_decode($base64Data);

            $imageName = time() . '.png'; // Add .png to the file name
            $imagePath = public_path('assets/images/' . $imageName);

            file_put_contents($imagePath, $imageData);

            $idProofPath = 'assets/images/' . $imageName;
        }

        return view('building-security.visitor.create', compact('tenants', 'nextVisitorId', 'visitor_id', 'idProofPath'));
    }

    public function visitor_store(Request $request)
    {
        // dd($request);
        $request->validate([
         
        ]);

        $destinationPath = public_path('assets/images/');
        $idProofPath = null;

       
        // if ($request->file('photo')) {
        //     $photoFileName = time() . '_' . $request->file('photo')->getClientOriginalName();
        //     $request->file('photo')->move($destinationPath, $photoFileName);
        //     $photoPath = 'assets/images/' . $photoFileName; // Path to store
        // }

        if ($request->id_file) {
            $base64Image = $request->id_file;
            $imageParts = explode(";base64,", $base64Image);

            if (count($imageParts) == 2) {
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1] ?? 'png';
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = time() . '_id_file.' . $imageType;

                file_put_contents($destinationPath . $fileName, $imageBase64);
                $idProofPath = 'assets/images/' . $fileName;
            }
        }

        if ($request->file('id_proof')) {
            $idProofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
            $request->file('id_proof')->move($destinationPath, $idProofFileName);
            $idProofPath = 'assets/images/' . $idProofFileName;
        }
// dd(Auth::guard('buildingSecutityadmin')->user()->building_id);
        $data = new Visitor_Master();
        $data->tenant_flat_office_no = $request->tenant_flat_office_no;
        $data->visitor_id = $request->VisitorId;
        $data->date = $request->date;
        $data->mobile =  $request->mobile;
        $data->whatsapp =  $request->whatsapp;
        $data->full_name = $request->full_name;
        $data->in_time = $request->in_time;
        $data->out_time = $request->out_time;
        $data->visitor_id_detected = $request->visitor_id;
        $data->visiter_purpose = $request->visiter_purpose;
        $data->building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;
        $data->status = 1;
        $data->photo = $request->photo ?? null;
        $data->id_proof = $idProofPath ?? null;
        $data->added_by = Auth::guard('buildingSecutityadmin')->user()->id;
        $data->created_at = now();

        $data->save();

        $store_full_name_visitore = Visitor::find($request->visitor_id);
        $store_full_name_visitore->name = $request->full_name;
        $store_full_name_visitore->save();



        return redirect()->route('building-security.visitor-index')
        ->with('success', 'Visitor added successfully');
}

    public function status_visitor($id)
    {
        $data = Visitor_Master::find($id);

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

        $security = Visitor_Master::find($securityId);
        if ($security) {
            $security->out_time_remark = $remark;
            $security->out_time = Carbon::now('Asia/Kolkata')->format('H:i');
            $security->save();
        }

        return redirect()->back()->with('success', 'Remark added successfully!');
    }

    public function blockSecurity(Request $request)
    {
        $response = $this->blockTenantService->blockSecurity($request);

        return response()->json($response);

    }

    public function saveAction(Request $request)
    {
        $response = $this->blockTenantService->saveAction($request);

        return response()->json($response);

    }

    public function repeat_create_visitor(Request $request)
    {

        // dd($request->all());

        $visitorData = $request->only(['visitor_id', 'is_new_visitor', 'building_type', 'capturedImageName']);

        $visitor_id = $request->visitor_id;
        $building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

        $lastVisitor = Visitor_Master::where('visitor_id', 'like', $building_id . '%')
            ->orderBy('visitor_id', 'desc')
            ->first();

        if ($lastVisitor) {
            $nextVisitorId = (int) $lastVisitor->visitor_id + 1;
        } else {
            $nextVisitorId = $building_id * 1000 + 1;
        }

        $tenants = BuildingAdminTenant::whereNull('sub_tenant_id')
            ->whereNotNull('flat_office_no')
            ->where('building_id', $building_id)
            ->get();

        $get_all_data = Visitor_Master::where('visitor_id_detected', $request->visitor_id)
            ->orderBy('created_at', 'desc')
            ->first();

        $get_all_records_for_visitor = Visitor_Master::where('visitor_id_detected', $request->visitor_id)->get();

        $matchingVisitors = Visitor_Master::where('visitor_id_detected', $request->visitor_id)->get();

        $matchingVisitorIds = $matchingVisitors->pluck('visitor_id');
        if ($matchingVisitors->isEmpty()) {
            return response()->json(['message' => 'No matching visitor found.'], 404);
        }

        // dd($matchingVisitorIds);

        // $get_block_resone = Visitor_Master::where('visitor_id', $matchingVisitorIds)->get('tenant_block');

        $isBlocked = BlockVisitor::whereIn('visitor_id', $matchingVisitorIds)
            ->select('block_tenant_remark')
            ->first();

        // dd($isBlocked);

        if ($isBlocked) {
            $blockTenantRemark = $isBlocked->block_tenant_remark; // Retrieve the remark
            $isBlockedFlag = 1; // Set the blocked flag to true
        } else {
            $blockTenantRemark = null; // No match found
            $isBlockedFlag = 0; // Set the blocked flag to false
        }

        $base64Image = $request->query('capturedPreview'); // Assume this is a base64 string
        if ($base64Image) {
            list($type, $base64Data) = explode(';', $base64Image);
            list(, $base64Data) = explode(',', $base64Data);
            $imageData = base64_decode($base64Data);

            $imageName = time() . '.png'; // Add .png to the file name
            $imagePath = public_path('assets/images/' . $imageName);

            file_put_contents($imagePath, $imageData);

            $idProofPath = 'assets/images/' . $imageName;
        }

        // dd( $isBlockedFlag);
        // $resone_for_block = Visitor_Master::where('visitor_id', $matchingVisitorIds)->get('tenant_block');

        // // Output the retrieved collection
        // dd($resone_for_block);

        // if ($isBlocked) {
        //     return response()->json(['message' => 'Visitor is blocked.'], 403);
        // }
        // dd('repete');

        return view('building-security.visitor.repeat-create', compact('blockTenantRemark', 'tenants', 'isBlockedFlag', 'nextVisitorId', 'visitor_id', 'get_all_data', 'get_all_records_for_visitor', 'isBlocked', 'idProofPath'));
    }

    public function repeate_visitor_store(Request $request)
    {

        // dd($request);
        $request->validate([
            'tenant_flat_office_no' => 'required',
            'VisitorId' => 'required',
            'visitor_id' => 'nullable',
            'date' => 'required',
            'full_name' => 'required',
            'in_time' => 'required',
            'out_time' => 'nullable',
             'mobile'=> 'required',
            'whatsapp'=> 'required',
            'visiter_purpose' => 'required',
            'photo' => 'nullable',
            'file' => 'nullable|string',
            'id_file' => 'nullable|string',
        ]);

        $destinationPath = public_path('assets/images/');
        $idProofPath = null;

        if ($request->file) {
            $base64Image = $request->file;
            $imageParts = explode(";base64,", $base64Image);

            if (count($imageParts) == 2) {
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1] ?? 'png';
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = time() . '_file.' . $imageType;

                // Save the base64 decoded image
                file_put_contents($destinationPath . $fileName, $imageBase64);
                $photoPath = 'assets/images/' . $fileName; // Path to store
            }
        }

     

        if ($request->id_file) {
            $base64Image = $request->id_file;
            $imageParts = explode(";base64,", $base64Image);

            if (count($imageParts) == 2) {
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1] ?? 'png';
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = time() . '_id_file.' . $imageType;

                file_put_contents($destinationPath . $fileName, $imageBase64);
                $idProofPath = 'assets/images/' . $fileName;
            }
        }

        if ($request->file('id_proof')) {
            $idProofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
            $request->file('id_proof')->move($destinationPath, $idProofFileName);
            $idProofPath = 'assets/images/' . $idProofFileName;
        }

        $visitorData = new Visitor_Master();
        $visitorData->tenant_flat_office_no = $request->tenant_flat_office_no;
        $visitorData->visitor_id = $request->VisitorId;
        $visitorData->date = $request->date;
        $visitorData->full_name = $request->full_name;
        $visitorData->mobile = $request->mobile;
        $visitorData->whatsapp = $request->whatsapp;
        $visitorData->in_time = $request->in_time;
        $visitorData->out_time = $request->out_time;
        $visitorData->visitor_id_detected = $request->visitor_id;
        $visitorData->visiter_purpose = $request->visiter_purpose;
        $visitorData->building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;
        $visitorData->status = 1;
        $visitorData->photo = $request->photo ?? null;
        $visitorData->id_proof = $idProofPath ?? null;
        $visitorData->added_by = Auth::guard('buildingSecutityadmin')->user()->id;
        $visitorData->created_at = now();

        // dd($visitorData);
        $visitorData->save();

        return redirect()->route('building-security.visitor-index');
    }

    public function check_block_tenant(Request $request)
    {
        $tenantId = $request->input('tenant_id');
        $visitorId = $request->input('visitor_id');

        $matchingVisitors = Visitor_Master::where('visitor_id_detected', $visitorId)->get();

        $mating_all_visitore_id = $matchingVisitors->pluck('visitor_id');

        // dd($mating_all_visitore_id);

        if ($matchingVisitors->isEmpty()) {
            return response()->json(['message' => 'No matching visitor found.'], 404);
        }

        $blockedVisitor = BlockVisitor::where('tenant_id', $tenantId)
            ->whereIn('visitor_id', $matchingVisitors->pluck('visitor_id_detected'))
            ->first();

        //   dd($blockedVisitor);

        if ($blockedVisitor) {
            return response()->json(['message' => 'This visitor is blocked for the selected tenant.'], 200);
        } else {
            return response()->json(['message' => 'Visitor is not blocked for this tenant.'], 200);
        }
    }

    public function getVisitorsByBuilding($building_id)
{
    $visitorMasterIds = Visitor_Master::where('building_id', $building_id)->pluck('visitor_id');
    
    $visitors = TenantVisitor::where('building_id', $building_id)
        ->whereNotIn('visitor_id', $visitorMasterIds)
        ->get(['id', 'full_name', 'visitor_id']);
    
    return response()->json($visitors);
}


    public function preCreateVisitor(Request $request)
    {
        // dd($request->all());
        $visitor = $request->query('pre_approved_visitor');
        $formData = $request->query(); // Gets all query parameters

        // dd($formData); // Dump and die to see all query data
        $visitor = $request->pre_approved_visitor;

        $building_id = $request->query('building_id') ?? Auth::guard('buildingSecutityadmin')->user()->building_id;

        // Handle image file upload
        $idProofPath = null;
        if ($request->hasFile('formData')) {
            $file = $request->file('formData');
            $destinationPath = public_path('assets/images');
            $idProofFileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $idProofFileName);
            $idProofPath = 'assets/images/' . $idProofFileName;
        }

        $base64Image = $request->query('capturedPreview'); 
        if ($base64Image) {
            list($type, $base64Data) = explode(';', $base64Image);
            list(, $base64Data) = explode(',', $base64Data);
            $imageData = base64_decode($base64Data);

            $imageName = time() . '.png'; 
            $imagePath = public_path('assets/images/' . $imageName);

            file_put_contents($imagePath, $imageData);

            $idProofPath = 'assets/images/' . $imageName;
        }

        $tenants = BuildingAdminTenant::whereNull('sub_tenant_id')
            ->whereNotNull('flat_office_no')
            ->where('building_id', $building_id)
            ->get();

        $preApproveMatchVisitor = TenantVisitor::where('id', $visitor)->first();

        if ($preApproveMatchVisitor === null) {
            return response()->json(['message' => 'Visitor not found'], 404);
        }

        return view('building-security.visitor.pre-visitor-create', compact('visitor', 'idProofPath', 'preApproveMatchVisitor', 'tenants'));
    }

    public function preStoreVisitor(Request $request)
    {
        // dd($request);
        $request->validate([
            'tenant_flat_office_no' => 'required',
            'VisitorId' => 'required',
            'visitor_id' => 'nullable',
            'date' => 'required',
            'full_name' => 'required',
            'in_time' => 'required',
            'out_time' => 'nullable',
            'visiter_purpose' => 'required',
            'photo' => 'nullable',
            'id_file' => 'nullable|string',
        ]);

    
        $destinationPath = public_path('assets/images/');
        $idProofPath = null;
        $photo = null; 
    
        if ($request->id_file) {
            $base64Image = $request->id_file;
            $imageParts = explode(";base64,", $base64Image);
    
            if (count($imageParts) == 2) {
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1] ?? 'png';
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = time() . '_id_file.' . $imageType;
    
                file_put_contents($destinationPath . $fileName, $imageBase64);
                $idProofPath = 'assets/images/' . $fileName;
            }
        }
    
        // Handle visitor photo upload
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photoFile = $request->file('photo');
            $photoFileName = time() . '_photo.' . $photoFile->getClientOriginalExtension();
            $photoFile->move($destinationPath, $photoFileName);
            $photo = 'assets/images/' . $photoFileName;
        }

    
        $visitorData = new Visitor_Master();
        $visitorData->tenant_flat_office_no = $request->tenant_flat_office_no;
        $visitorData->visitor_id = $request->VisitorId;
        $visitorData->date = $request->date;
        $visitorData->full_name = $request->full_name;
        $visitorData->in_time = $request->in_time;
        $visitorData->out_time = $request->out_time;
        $visitorData->visitor_id_detected = $request->visitor_id;
        $visitorData->visiter_purpose = $request->visiter_purpose;
        $visitorData->building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;
        $visitorData->status = 1;
        $visitorData->status_of_visitor = 0;
        $visitorData->visitor_remark = 'Preapproved';
        $visitorData->pre_approve_tenant_visitore_id = $request->VisitorId;
        $visitorData->photo = $request->photo ?? null;
        $visitorData->id_proof = $idProofPath ?? null;
        $visitorData->added_by = Auth::guard('buildingSecutityadmin')->user()->id;
        $visitorData->created_at = now();
    
        // Save the visitor data
        $visitorData->save();
    
        // Update the visitor's full name
        // $store_full_name_visitore = Visitor::find($request->visitor_id);
        // dd($request);
        // $store_full_name_visitore->name = $request->full_name;
        // $store_full_name_visitore->save();
    
        return redirect()->route('building-security.visitor-index');
    }
    
    public function index_visitor_for_add_tenant()
    {

        $bulding_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

        $security_data = TenantVisitor::where('building_id', $bulding_id)
            ->get();

            return view('building-security.visitor.pre-approve-index-in-visitor', compact('security_data'));
        }
}
