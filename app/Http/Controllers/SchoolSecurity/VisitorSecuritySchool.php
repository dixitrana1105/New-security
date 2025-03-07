<?php

namespace App\Http\Controllers\SchoolSecurity;

use App\Http\Controllers\Controller;
use App\Models\SchoolSecurityVisitor;
use App\Models\SchoolStudents;
use App\Models\Visitor;
use App\Models\SchoolSecurityBlock;
use Carbon\Carbon;
use App\Services\BlockTenantService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorSecuritySchool extends Controller
{
    protected $blockTenantService;  

    public function __construct(BlockTenantService $blockTenantService)
    {
        $this->blockTenantService = $blockTenantService;
    }

    public function index()
    {
        $id = Auth::guard('schoolsecurity')->user()->id;
        $currentTime = Carbon::now()->format('H:i:s');
        $visitor = SchoolSecurityVisitor::where('added_by', $id)
            ->whereDate('date', Carbon::today())
            ->where(function ($query) use ($currentTime) {
                $query->whereNull('out_time')
                    ->orWhere('out_time', '>', $currentTime);
            })->whereNull('out_time_remark')
            ->get();

            // dd($visitor);
// dd('ook');

        return view('school-security.visitor.index', compact('visitor'));
    }

    public function create(Request $request)
    {
        $visitorData = $request->only(['visitor_id', 'is_new_visitor', 'building_type']);

        $latestVisitorID = SchoolSecurityVisitor::latest('visitor_id')->first();
        $visitor_id = $request->visitor_id;

        if ($latestVisitorID) {
            $lastId = intval($latestVisitorID->visitor_id);
            $nextId = str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nextId = '444444';
        }
        $class = SchoolStudents::select('class')->distinct()->get();
        $section = SchoolStudents::select('section')->get();
        $student = SchoolStudents::select('name')->get();
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
        return view('school-security.visitor.create', compact('nextId', 'class', 'section', 'student','visitor_id','idProofPath'));
    }

    public function getSectionsByClass(Request $request)
    {
        $class = $request->input('class');
        $sections = SchoolStudents::where('class', $class)->select('section')->distinct()->get();
        return response()->json($sections);
    }

    public function getStudentsBySection(Request $request)
    {
        $section = $request->input('section');
        $students = SchoolStudents::where('section', $section)->select('name')->get();
        return response()->json($students);
    }

    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'VisitorId' => 'required',
            'date' => 'required|date',
            'class' => 'required',
            'visitor_id' => 'nullable',
            'section' => 'required',
            'student' => 'required',
            'name' => 'required',
            'visiter_purpose' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'whatsapp' => 'required',
            'in_time' => 'required',
            'out_time' => '',
            'proof' => 'nullable|string',
            'photo' => 'nullable|string',
        ]);

        $destinationPath = public_path('assets/images/');
        // $photoPath = null;
        $idProofPath = null;

        // if ($request->photo) {
        //     $base64Image = $request->photo;
        //     $imageParts = explode(";base64,", $base64Image);
    
        //     if (count($imageParts) == 2) {
        //         $imageTypeAux = explode("image/", $imageParts[0]);
        //         $imageType = $imageTypeAux[1] ?? 'png'; 
        //         $imageBase64 = base64_decode($imageParts[1]);
        //         $fileName = time() . '_photo.' . $imageType;
    
        //         // Save the base64 decoded image
        //         file_put_contents($destinationPath . $fileName, $imageBase64);
        //         $photoPath = 'assets/images/' . $fileName; // Path to store
        //     }
        // }
    
        // if ($request->file('photo')) {
        //     $photoFileName = time() . '_' . $request->file('photo')->getClientOriginalName();
        //     $request->file('photo')->move($destinationPath, $photoFileName);
        //     $photoPath = 'assets/images/' . $photoFileName; // Path to store
        // }
    
        if ($request->proof) {
            $base64Image = $request->proof;
            $imageParts = explode(";base64,", $base64Image);
    
            if (count($imageParts) == 2) {
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1] ?? 'png'; 
                $imageBase64 = base64_decode($imageParts[1]);
                $fileName = time() . '_proof.' . $imageType;
    
              
                file_put_contents($destinationPath . $fileName, $imageBase64);
                $idProofPath = 'assets/images/' . $fileName; 
            }
        }
    
        if ($request->file('id_proof')) {
            $idProofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
            $request->file('id_proof')->move($destinationPath, $idProofFileName);
            $idProofPath = 'assets/images/' . $idProofFileName; 
        }

        $id = Auth::guard('schoolsecurity')->user()->id;

        $visitor = new SchoolSecurityVisitor();
        $visitor->visitor_id = $validatedData['VisitorId'];
        $visitor->date = $validatedData['date'];
        $visitor->class = $validatedData['class'];
        $visitor->section = $validatedData['section'];
        $visitor->student_name = $validatedData['student'];
        $visitor->visitor_name = $validatedData['name'];
        $visitor->email = $validatedData['email'];
        $visitor->mobile = $validatedData['mobile'];
        $visitor->whatsapp = $validatedData['whatsapp'];
        $visitor->in_time = $validatedData['in_time'];
        $visitor->out_time = $validatedData['out_time'];
        $visitor->id_proof = $idProofPath ?? null;
        $visitor->photo = $request->photo ?? null;
        $visitor->added_by = $id;
        $visitor->visiter_purpose = $validatedData['visiter_purpose'];
        $visitor->visitor_id_detected = $request->visitor_id;
        $visitor->status = 1;

        $visitor->save();

        $store_full_name_visitore = Visitor::find($request->visitor_id);
        $store_full_name_visitore->name = $request->full_name;
        $store_full_name_visitore->save();


        return redirect()->route('school.security.visitor.index')->with('success', 'Visitor data saved successfully');
    }

    public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $data = SchoolSecurityVisitor::findOrFail($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

    public function storeOutTimeRemark(Request $request)
    {

        $request->validate([
            'security_id' => 'required|exists:school_security_visitor,id',
            'out_time_remark' => 'required|string|max:255',
        ]);


        $securityId = $request->input('security_id');
        $remark = $request->input('out_time_remark');

        $item = SchoolSecurityVisitor::find($securityId);
        if ($item) {
            $item->out_time_remark = $remark;
            $item->out_time = Carbon::now('Asia/Kolkata')->format('H:i');
            $item->save();
        }
        
        return redirect()->back()->with('success', 'Remark added successfully.');
    }

    public function block(Request $request)
{    
    $response = $this->blockTenantService->blockSchoolVisitor($request);

    return response()->json($response);
}

    public function repeat_visitor_create(Request $request)
    {
        $visitorData = $request->only(['visitor_id', 'is_new_visitor', 'building_type', 'capturedImageName']);
        $visitor_id = $request->visitor_id;
        $building_id = Auth::guard('schoolsecurity')->user()->added_by;
        $latestVisitorID = SchoolSecurityVisitor::latest('visitor_id')->first();
        $visitor_id = $request->visitor_id;

        if ($latestVisitorID) {
            $lastId = intval($latestVisitorID->visitor_id);
            $nextId = str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nextId = '444444';
        }

        $visiterdata = SchoolSecurityVisitor::where('visitor_id_detected', $visitor_id)
        ->orderBy('created_at', 'desc')
        ->first();

        $class = SchoolStudents::select('class')->distinct()->get();
        $section = SchoolStudents::select('section')->get();
        $student = SchoolStudents::select('name')->get();

        $get_all_records_for_school_visitor = SchoolSecurityVisitor::where('visitor_id_detected', $request->visitor_id)
        ->orderBy('created_at', 'desc')
        ->get();

        $matchingVisitors = SchoolSecurityVisitor::where('visitor_id_detected', $request->visitor_id)->get();

        $matchingVisitorIds = $matchingVisitors->pluck('visitor_id');
            if ($matchingVisitors->isEmpty()) {
            return response()->json(['message' => 'No matching visitor found.'], 404);
        }
    
        $isBlocked = SchoolSecurityBlock::whereIn('visitor_id', $matchingVisitorIds)
        ->select('remark')
        ->first();

    
        if ($isBlocked) {
            $blockTenantRemark = $isBlocked->remark; // Retrieve the remark
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

        return view('school-security.visitor.repeat-create',compact('class', 'section', 'student','visiterdata','visitor_id',
        'get_all_records_for_school_visitor','nextId' ,'isBlockedFlag','isBlocked','idProofPath'));


    }

}
