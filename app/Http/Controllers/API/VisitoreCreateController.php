<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Rekognition;
use App\Models\Visitor_Master;
use App\Models\Visitor;
use App\Services\Aws;
use Illuminate\Http\Request;
use Validator;

class VisitoreCreateController extends Controller
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

    public function addVisitore(Request $request)
    {
        try {
            // Validate request input
            // dd($request);
            $validator = Validator::make($request->all(), [
                'building_id' => 'required',
                'building_type' => 'required',
                'current_scan_image' => 'required',
                'visitor_id' => 'required',
                'is_new_visitor' => 'required|true|false',
                'tenant_flat_office_no' => 'required',
                'date' => 'nullable',
                'full_name' => 'nullable',
                'mobile' => 'nullable',
                'whatsapp' => 'nullable',
                'out_time' => 'nullable',
                'visiter_purpose' => 'nullable',
                'id_proof' => 'nullable',
            ]);

            // dd($request->current_scan_image);

        

            // Generate next visitor ID
            $lastVisitor = Visitor_Master::where('visitor_id', 'like', $request->building_id . '%')
                ->orderBy('visitor_id', 'desc')
                ->first();

            $nextVisitorId = $lastVisitor
            ? (int) $lastVisitor->visitor_id + 1
            : $request->building_id * 1000 + 1;

            // Handle image uploads
            $destinationPath = public_path('assets/images/');
            $photoPath = null;
            $idProofPath = null;

            if ($request->file('current_scan_image')) {
                $photoFileName = time() . '_' .uniqid().'_'. $request->file('current_scan_image')->getClientOriginalName();
                // dd($request->file('current_scan_image')->move($destinationPath, $photoFileName));
                $request->file('current_scan_image')->move($destinationPath, $photoFileName);
                $photoPath = 'assets/images/' . $photoFileName;
            }
            // if ($request->file('current_scan_image')) {
            //     $file = $request->file('current_scan_image');
            
            //     $extension = $file->getClientOriginalExtension();
            
            //     if (!$extension) {
            //         $mimeType = $file->getMimeType(); // Get the MIME type
            //         $extension = \Illuminate\Support\Facades\File::mimeTypeToExtension($mimeType);
            //     }
            
            //     $photoFileName = time() . '_' . uniqid() . '.' . $extension;
            
            //     $destinationPath = 'assets/images';
            //     $file->move($destinationPath, $photoFileName);
            
            //     $photoPath = $destinationPath . '/' . $photoFileName;
            
            //     // Debug output
            //     // dd('File saved to: ' . $photoPath);
            // }
            // dd($photoPath);

            if ($request->id_file) {
                $idProofPath = $this->saveBase64Image($request->id_file, $destinationPath);
            }

            if ($request->file('id_proof')) {
                $idProofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
                $request->file('id_proof')->move($destinationPath, $idProofFileName);
                $idProofPath = 'assets/images/' . $idProofFileName;
            }

            // dd($photoPath,$idProofPath);
            if ($request->is_new_visitor === 'true') {

                $visitorData = Visitor_Master::create([
                    'tenant_flat_office_no' => $request->tenant_flat_office_no,
                    'visitor_id' => $nextVisitorId,
                    'date' => $request->date,
                    'full_name' => $request->full_name,
                    'mobile' => $request->mobile,
                    'whatsapp' => $request->whatsapp,
                    'in_time' => now(),
                    'out_time' => $request->out_time,
                    'visitor_id_detected' => $request->visitor_id,
                    'visiter_purpose' => $request->visiter_purpose,
                    'building_id' => $request->building_id,
                    'status' => 1,
                    // dd($photoPath),
                    'photo' => $photoPath,
                    'id_proof' => $idProofPath,
                    'added_by' => $request->building_id,
                    'created_at' => now(),
                ]);
                $store_full_name_visitore = Visitor::find($request->visitor_id);
                $store_full_name_visitore->name = $request->full_name;
                $store_full_name_visitore->save();
            } else {

                $last_visitor_data = Visitor_Master::where('visitor_id_detected', $request->visitor_id)
                ->latest('created_at')
                ->first();
            

                $visitorData = Visitor_Master::create([
                    'tenant_flat_office_no' => $request->tenant_flat_office_no,
                    'visitor_id' => $nextVisitorId,
                    'date' => $request->date,
                    'full_name' => $last_visitor_data->full_name,
                    'mobile' => $last_visitor_data->mobile,
                    'whatsapp' => $last_visitor_data->whatsapp,
                    'in_time' => now(),
                    'out_time' => $request->out_time,
                    'visitor_id_detected' => $request->visitor_id,
                    'visiter_purpose' => $request->visiter_purpose,
                    'building_id' => $request->building_id,
                    'status' => 1,
                    'photo' => $photoPath,
                    'id_proof' => $idProofPath,
                    'added_by' => $request->building_id,
                    'created_at' => now(),
                ]);
                $store_full_name_visitore = Visitor::find($request->visitor_id);
                $store_full_name_visitore->name = $request->full_name;
                $store_full_name_visitore->save();
            }

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
        } catch(\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        } catch (\Error $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    
}
