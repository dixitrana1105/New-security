<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SchoolSecurityVisitor;
use App\Models\Visitor_Master;
use App\Models\Visitor;
use App\Services\Aws;
use App\Models\TokenApi;
use Illuminate\Http\Request;
use Validator;

class SchoolVisitoreCreateController extends Controller
{
    private $aws;

    public function __construct(Request $request, Aws $aws)
    {
        if ($request->route()->getActionMethod() === 'new_visitor_scan') {
            return;
        }
        if ($request->has('building_id') && $request->has('building_type')) {
            $buildingType = $request->get('building_type');
            $buildingId = $request->get('building_id');

            if (empty($buildingType) || empty($buildingId)) {
                throw new \InvalidArgumentException('Both building_type and building_id are required.');
            }

            if (!is_string($buildingType) || !is_numeric($buildingId)) {
                throw new \InvalidArgumentException('Invalid format: building_type should be a string, and building_id should be numeric.');
            }
            $uniqueCollectionId = $buildingType . '_' . $buildingId;
            $aws->setCollectionId($uniqueCollectionId);
        } else {
            throw new \InvalidArgumentException('Request must contain both building_id and building_type.');
        }

        $this->aws = $aws;
    }

    // public function addVisitoreforSchool(Request $request)
    // {

    //     try {
    //         // dd('ok');

    //         Validator::make($request->all(), [
    //             'building_id' => 'required',
    //             'building_type' => 'required',
    //             'file' => 'required',
    //         ]);

    //                     $lastVisitor = SchoolSecurityVisitor::where('visitor_id', 'like', $request->building_id . '%')
    //                         ->orderBy('visitor_id', 'desc')
    //                         ->first();

    //                     if ($lastVisitor) {
    //                         $nextVisitorId = (int) $lastVisitor->visitor_id + 1;
    //                     } else {
    //                         $nextVisitorId = $building_id * 1000 + 1;
    //                     }

    //                     $destinationPath = public_path('assets/images/');
    //                     $photoPath = null;
    //                     $idProofPath = null;

    //                     if ($request->file) {
    //                         $base64Image = $request->file;
    //                         $imageParts = explode(";base64,", $base64Image);

    //                         if (count($imageParts) == 2) {
    //                             $imageTypeAux = explode("image/", $imageParts[0]);
    //                             $imageType = $imageTypeAux[1] ?? 'png';
    //                             $imageBase64 = base64_decode($imageParts[1]);
    //                             $fileName = time() . '_file.' . $imageType;

    //                             file_put_contents($destinationPath . $fileName, $imageBase64);
    //                             $photoPath = 'assets/images/' . $fileName;
    //                         }
    //                     }

    //                     if ($request->file('file')) {
    //                         $photoFileName = time() . '_' . $request->file('file')->getClientOriginalName();
    //                         $request->file('file')->move($destinationPath, $photoFileName);
    //                         $photoPath = 'assets/images/' . $photoFileName;
    //                     }

    //                     if ($request->id_file) {
    //                         $base64Image = $request->id_file;
    //                         $imageParts = explode(";base64,", $base64Image);

    //                         if (count($imageParts) == 2) {
    //                             $imageTypeAux = explode("image/", $imageParts[0]);
    //                             $imageType = $imageTypeAux[1] ?? 'png';
    //                             $imageBase64 = base64_decode($imageParts[1]);
    //                             $fileName = time() . '_id_file.' . $imageType;

    //                             file_put_contents($destinationPath . $fileName, $imageBase64);
    //                             $idProofPath = 'assets/images/' . $fileName;
    //                         }
    //                     }

    //                     if ($request->file('id_proof')) {
    //                         $idProofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
    //                         $request->file('id_proof')->move($destinationPath, $idProofFileName);
    //                         $idProofPath = 'assets/images/' . $idProofFileName;
    //                     }
    //                     $blockedById = TokenApi::where('user_type', $type)->first()?->user_id;

    //                     $visitorData = new SchoolSecurityVisitor();
    //                     $visitorData->visitor_id = $nextVisitorId;
    //                     $visitorData->date = date('Y-m-d');
    //                     $visitorData->class = $request->class;
    //                     $visitorData->section = $request->section;
    //                     $visitorData->student_name = $request->student_name;
    //                     $visitorData->visitor_name = $request->visitor_name;
    //                     $visitorData->email = $request->email;
    //                     $visitorData->mobile = $request->mobile;
    //                     $visitorData->whatsapp = $request->whatsapp;
    //                     $visitorData->in_time = now();
    //                     $visitorData->out_time = $request->out_time;
    //                     $visitorData->visitor_id_detected = $old_visitor->id;
    //                     $visitorData->photo = $photoPath ?? null;
    //                     $visitorData->id_proof = $idProofPath ?? null;
    //                     $visitorData->added_by = $blockedById;
    //                     $visitorData->status = 1;
    //                     $visitorData->visiter_purpose = $request->visiter_purpose;
    //                     $visitorData->save();

    //                     return response()->json([
    //                         'success' => true,
    //                         'message' => 'User found and Visitor data saved successfully',
    //                         'data' => $visitorData,
    //                     ]);

    //                 }

    //                 // }

    //                 $lastVisitor = Visitor_Master::where('visitor_id', 'like', $request->building_id . '%')
    //                     ->orderBy('visitor_id', 'desc')
    //                     ->first();

    //                 // dd($data);

    //                 if ($lastVisitor) {
    //                     $nextVisitorId = (int) $lastVisitor->visitor_id + 1;
    //                 } else {
    //                     $nextVisitorId = $building_id * 1000 + 1;
    //                 }

    //                 $destinationPath = public_path('assets/images/');
    //                 $photoPath = null;
    //                 $idProofPath = null;

    //                 if ($request->file) {
    //                     $base64Image = $request->file;
    //                     $imageParts = explode(";base64,", $base64Image);

    //                     if (count($imageParts) == 2) {
    //                         $imageTypeAux = explode("image/", $imageParts[0]);
    //                         $imageType = $imageTypeAux[1] ?? 'png';
    //                         $imageBase64 = base64_decode($imageParts[1]);
    //                         $fileName = time() . '_file.' . $imageType;

    //                         file_put_contents($destinationPath . $fileName, $imageBase64);
    //                         $photoPath = 'assets/images/' . $fileName;
    //                     }
    //                 }

    //                 if ($request->file('file')) {
    //                     $photoFileName = time() . '_' . $request->file('file')->getClientOriginalName();
    //                     $request->file('file')->move($destinationPath, $photoFileName);
    //                     $photoPath = 'assets/images/' . $photoFileName; // Path to store
    //                 }

    //                 if ($request->id_file) {
    //                     $base64Image = $request->id_file;
    //                     $imageParts = explode(";base64,", $base64Image);

    //                     if (count($imageParts) == 2) {
    //                         $imageTypeAux = explode("image/", $imageParts[0]);
    //                         $imageType = $imageTypeAux[1] ?? 'png';
    //                         $imageBase64 = base64_decode($imageParts[1]);
    //                         $fileName = time() . '_id_file.' . $imageType;

    //                         file_put_contents($destinationPath . $fileName, $imageBase64);
    //                         $idProofPath = 'assets/images/' . $fileName;
    //                     }
    //                 }

    //                 if ($request->file('id_proof')) {
    //                     $idProofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
    //                     $request->file('id_proof')->move($destinationPath, $idProofFileName);
    //                     $idProofPath = 'assets/images/' . $idProofFileName;
    //                 }

    //                 $visitorData = new SchoolSecurityVisitor();
    //                 $visitorData->visitor_id = $nextVisitorId;
    //                 $visitorData->date = date('Y-m-d');
    //                 $visitorData->class = $request->class;
    //                 $visitorData->section = $request->section;
    //                 $visitorData->student_name = $request->student_name;
    //                 $visitorData->visitor_name = $request->visitor_name;
    //                 $visitorData->email = $request->email;
    //                 $visitorData->mobile = $request->mobile;
    //                 $visitorData->whatsapp = $request->whatsapp;
    //                 $visitorData->in_time = now();
    //                 $visitorData->out_time = $request->out_time;
    //                 $visitorData->visitor_id_detected = $visitor->id;
    //                 $visitorData->photo = $photoPath ?? null;
    //                 $visitorData->id_proof = $idProofPath ?? null;
    //                 $visitorData->added_by = $blockedById;
    //                 $visitorData->status = 1;
    //                 $visitorData->visiter_purpose = $request->visiter_purpose;
    //                 $visitorData->save();

    //                 return response()->json([
    //                     'success' => true,
    //                     'message' => 'User Not Found And Visitor data saved successfully',
    //                     'data' => $visitorData,
    //                 ]);

    //                 return response()->json($data);
    //             }
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Face detected successfully, User Not found but something went wrong and possiblity thet data hase remove from visitore table and not from AWS rekognition collection on AWS',
    //             ]);

    //         }

    //         if ($response->getStatusCode() == 400) {

    //             // dd($response);
    //             return response()->json([
    //                 'status' => false,
    //                 'message' => 'Error detecting face from Service',
    //             ]);
    //         }

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Error detecting face',
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage(),
    //         ]);

    //     }
    // }

    public function addVisitoreforSchool(Request $request)
    {
        try {
            // Validate request input
            $validator = Validator::make($request->all(), [
                'building_id' => 'required',
                'building_type' => 'required',
                'current_scan_image' => 'required',
                'visitor_id' => 'required',
                'is_new_visitor' => 'required|in:true,false',
                'date' => 'nullable',
                'class' => 'required',
                'section' => 'required',
                'student_name' => 'required',
                'visitor_name' => 'required',
                'email' => 'required',
                'mobile' => 'nullable',
                'whatsapp' => 'nullable',
                'out_time' => 'nullable',
                'visiter_purpose' => 'nullable',
                'id_proof' => 'nullable',
            ]);
    
            // Generate next visitor ID
            $lastVisitor = Visitor_Master::where('visitor_id', 'like', $request->building_id . '%')
                ->orderBy('visitor_id', 'desc')
                ->first();
    
            $nextVisitorId = $lastVisitor 
                ? (int) $lastVisitor->visitor_id + 1 
                : $request->building_id * 1000 + 1;

                // dd($nextVisitorId);
                $blockedById = TokenApi::where('user_type', $request->building_type)->first()?->user_id;
                // dd($blockedById);
            // Handle image uploads
            $destinationPath = public_path('assets/images/');
            $photoPath = null;
            $idProofPath = null;
    
            if ($request->hasFile('current_scan_image')) {
                $photoFileName = time() . '_' . $request->file('current_scan_image')->getClientOriginalName();
                $request->file('current_scan_image')->move($destinationPath, $photoFileName);
                $photoPath = 'assets/images/' . $photoFileName;
            }
    
            if ($request->id_file) {
                $idProofPath = $this->saveBase64Image($request->id_file, $destinationPath);
            }
    
            if ($request->hasFile('id_proof')) {
                $idProofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
                $request->file('id_proof')->move($destinationPath, $idProofFileName);
                $idProofPath = 'assets/images/' . $idProofFileName;
            }
            $visitorData = new SchoolSecurityVisitor();

    
            if ($request->is_new_visitor === 'true') {
                // dd('true');
                // Handle new visitor data
                    $visitorData->visitor_id = $nextVisitorId;
                    $visitorData->date = date('Y-m-d');
                    $visitorData->class = $request->class;
                    $visitorData->section = $request->section;
                    $visitorData->student_name = $request->student_name;
                    $visitorData->visitor_name = $request->visitor_name;
                    $visitorData->email = $request->email;
                    $visitorData->mobile = $request->mobile;
                    $visitorData->whatsapp = $request->whatsapp;
                    $visitorData->in_time = now();
                    $visitorData->out_time = $request->out_time;
                    $visitorData->visitor_id_detected = $request->visitor_id;
                    $visitorData->photo = $photoPath ?? null;
                    $visitorData->id_proof = $idProofPath ?? null;
                    $visitorData->added_by = $blockedById;
                    $visitorData->status = 1;
                    $visitorData->visiter_purpose = $request->visiter_purpose;
            } else {
                // dd('false');
                // Handle returning visitor data
                $lastVisitorData = SchoolSecurityVisitor::where('visitor_id_detected', $request->visitor_id)
                    ->latest('created_at')
                    ->first();

                    // dd($lastVisitorData);
    
                $visitorData->visitor_id = $nextVisitorId;
                $visitorData->date = date('Y-m-d');
                $visitorData->class = $request->class;
                $visitorData->section = $request->section;
                $visitorData->student_name = $request->student_name;
                $visitorData->visitor_name = $lastVisitorData->visitor_name;
                $visitorData->email = $lastVisitorData->email;
                $visitorData->mobile = $lastVisitorData->mobile;
                $visitorData->whatsapp = $lastVisitorData->whatsapp;
                $visitorData->in_time = now();
                $visitorData->out_time = $request->out_time;
                $visitorData->visitor_id_detected = $request->visitor_id;
                $visitorData->photo = $photoPath;
                $visitorData->id_proof = $idProofPath;
                $visitorData->added_by = $blockedById;
                $visitorData->status = 1;
                $visitorData->visiter_purpose = $request->visiter_purpose;
            }

           $visitorData->save();

            $store_full_name_visitore = Visitor::find($request->visitor_id);
            $store_full_name_visitore->name = $request->full_name;
            $store_full_name_visitore->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Visitor data saved successfully.',
                'data' => $visitorData,
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    

}
