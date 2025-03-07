<?php

namespace App\Http\Controllers;

use App\Models\Building_Master;
use App\Models\Rekognition;
use App\Models\Visitor;
use App\Models\Visitor as User;
use App\Models\Visitor_Master;
use App\Models\TenantVisitor;
use App\Services\Aws;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Api extends Controller
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

    public function detect_face(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'file' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->messages(),
                ])->setStatusCode(400);
            }

            // $aws = new Aws;
            $bytes = fileToBytes($request->file('file'));

            $data = $this->aws->getSearchFacesByImage($bytes);
            // dd($data);
            if (!$data->get('FaceMatches')) {
                $data = $this->aws->getIndexFaces($bytes);
                $faceId = $data->get('FaceRecords')[0]['Face']['FaceId'];
                $imageId = $data->get('FaceRecords')[0]['Face']['ImageId'];

                return response()->json([
                    'status' => true,
                    'message' => 'Face detected successfully, User Not found',
                    'data' => [
                        'faceId' => $faceId,
                        'imageId' => $imageId,
                    ],
                ]);
            }

            $faceIds = array_map(fn($item) => $item['Face']['FaceId'], $data->get('FaceMatches'));
            $usersByFaceId = Rekognition::whereIn('faceId', $faceIds)
                ->with('users:id,name,email')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->faceId => $item->users];
                })
                ->toArray();
            // dd($usersByFaceId);
            $users = array_map(function ($item) use ($usersByFaceId) {
                $faceId = $item['Face']['FaceId'];
                $item['users'] = $usersByFaceId[$faceId] ?? null;

                return $item;
            }, $data->get('FaceMatches'));

            return response()->json([
                'status' => true,
                'message' => 'Face detected successfully',
                'data' => $users,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ])->setStatusCode(400);
        }
    }

    public function controller_detect_face(Request $request)
    {

        // dd('ok');
        try {

            Validator::make($request->all(), [
                'building_id' => 'required',
                'building_type' => 'required',
                'file' => 'required',
            ]);
            $response = $this->detect_face($request);
            
            if ($response && $response->getStatusCode() == 200) {
                $responseData = (json_decode($response->getContent(), true));
                // dd($responseData);
                if (!empty($responseData['data']) && count($responseData['data']) > 0) {
                    if (isset($responseData['data'][0]['users']) && $responseData['data'][0]['users'] !== null) {
                        if (count($responseData['data']) > 1) {

                            return response()->json([
                                'status' => false,
                                'message' => 'Multiple faces detected',
                            ]);
                        }
                    }
                }

                if ((!$responseData['data'] || !isset($responseData['data'][0]['users']) || $responseData['data'][0]['users'] == null) && !isset($responseData['data']['faceId'])) {
                    
                    $data['status'] = true;
                    $data['message'] = 'Face detected successfully, User Not found';
                    $visitor = new Visitor;
                    $old_visitor = Visitor::where('faceId', $responseData['data'][0]['Face']['FaceId'])->where('building_id', $request->get('building_id'))->where('building_type', $request->get('building_type'))->where('status', '1')->first();
                    // dd($old_visitor);
                    if( isset($old_visitor->name) && $old_visitor->name != null){
                        $get_all_records_for_visitor = Visitor_Master::where('visitor_id_detected', $old_visitor->id)->get();
                        if ($old_visitor || $old_visitor != null) {
                            $data['message'] = 'Face detected successfully, User found';
                            $data['data'] = [
                                'visitor_id' => $old_visitor->id,
                                'is_new_visitor' => false,
                                'building_type' => $request->building_type,
                                'visitor_records' => $get_all_records_for_visitor->toArray(),
                                'current_scan_image' => $request->file('file')->store(),    
    
                            ];
    
                            // $response = Http::post(route('api.face-scan.handle-visitor'), $data['data']);
    
                            return response()->json($data);
                        }    
                    } elseif (isset($old_visitor->id)) {
                        $data['data'] = [
                            'visitor_id' => $old_visitor->id,
                            'is_new_visitor' => true,
                            'building_type' => $request->building_type,
                            'current_scan_image' => $request->file('file')->store(),    
    
                        ];
                        $data['message'] = 'Face detected successfully, User Not found';
                        $data['status'] = true;
    
                        return response()->json($data);
                    } else {
                        // dd($responseData['data'][0]['Face']);
                        $faceId = $responseData['data'][0]['Face']['FaceId'];
                        $imageId = $responseData['data'][0]['Face']['ImageId'];
                        $visitor = new Visitor;
                        $visitor = Visitor::create([
                            'faceId' => $faceId,
                            'imageId' => $imageId,
                            'building_id' => $request->get('building_id'),
                            'building_type' => $request->get('building_type'),
                        ]);
                        $data['data'] = [
                            'visitor_id' => $visitor->id,
                            'is_new_visitor' => true,
                            'building_type' => $request->building_type,
                            'current_scan_image' => $request->file('file')->store(),    
    
                        ];
                        $data['message'] = 'Face detected successfully, User Not found';
                        $data['status'] = true;
    
                        return response()->json($data);
                    }
                    

                } elseif (isset($responseData['data']) && isset($responseData['data']['faceId'])) {
                    $faceId = $responseData['data']['faceId'];
                    $imageId = $responseData['data']['imageId'];
                    $visitor = new Visitor;
                    $visitor = Visitor::create([
                        'faceId' => $faceId,
                        'imageId' => $imageId,
                        'building_id' => $request->get('building_id'),
                        'building_type' => $request->get('building_type'),
                    ]);
                    $data['data'] = [
                        'visitor_id' => $visitor->id,
                        'is_new_visitor' => true,
                        'building_type' => $request->building_type,
                        'current_scan_image' => $request->file('file')->store(),    

                    ];
                    $data['message'] = 'Face detected successfully, User Not found';
                    $data['status'] = true;

                    return response()->json($data);
                }
                return response()->json([
                    'status' => false,
                    'message' => 'Face detected successfully, User Not found but something went wrong and possiblity thet data hase remove from visitore table and not from AWS rekognition collection on AWS',
                ]);

            }

            if ($response->getStatusCode() == 400) {

                // dd($response);
                return response()->json([
                    'status' => false,
                    'message' => 'Error detecting face from Service',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Error detecting face',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);

        }
    }

    public function create_user_with_face(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:visitors',
                'password' => 'required|string',
                'faceId' => 'required|string',
                'imageId' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->messages(),
                ])->setStatusCode(400);
            }

            $user = new User;
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->password = $request->get('password');
            $user->imageUrl = '';
            $user->save();

            $rekognition = new Rekognition;
            $rekognition->faceId = $request->get('faceId');
            $rekognition->imageId = $request->get('imageId');

            $rekognition->userId = $user->id;
            $rekognition->save();

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ])->setStatusCode(400);
        }
    }

    public function delete_collection(Request $request)
    {
        // $aws = new Aws;
        $this->aws->deleteCollection();

        return response()->json([
            'status' => true,
            'message' => 'Collection deleted successfully',
        ])->setStatusCode(200);
    }

    public function new_visitor_scan()
    {
        $building_id = $this->getBuildingId();
        if (!$building_id) {
            return redirect()->route('super-admin.login');
        }
        $building_type = Building_Master::where('id', $building_id)->first()->type;
        $data = [
            'building_id' => $building_id,
            'building_type' => $building_type,
        ];

        return view('new_visitor_scan', compact('data'));
    }

   
}
