<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SchoolSecurityVisitor;
use App\Models\Visitor_Master;
use App\Models\SchoolStudents;
use App\Models\BuildingAdminTenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class VisitorgetController extends Controller
{
    private function getVisitorsQuery($type, $building_id, $additionalFilters = [], $dateRange = null)
    {
        // dd($type, $building_id, $additionalFilters, $dateRange);
        if ($type === 'building') {
            $query = Visitor_Master::where('building_id', $building_id);
            if (! empty($additionalFilters['out_time_remark'])) {
                $query->whereNull('out_time_remark');
            } elseif (! empty($additionalFilters['not_out_time_remark'])) {
                $query->whereNotNull('out_time_remark');
            }

            if (! empty($dateRange) && count($dateRange) === 2 && $dateRange[0] && $dateRange[1]) {
                $query->whereBetween('date', $dateRange);
            }

            if (! empty($additionalFilters['tenant_flat_office_no'])) {
                $query->where('tenant_flat_office_no', $additionalFilters['tenant_flat_office_no']);
            }

            if (! empty($additionalFilters['visitor_name'])) {
                $query->where(function ($query) use ($additionalFilters) {
                    $query->where('full_name', 'like', '%'.$additionalFilters['visitor_name'].'%')
                        ->orWhere('full_name', 'like', '%'.strtolower($additionalFilters['visitor_name']).'%')
                        ->orWhere('full_name', 'like', '%'.ucfirst($additionalFilters['visitor_name']).'%')
                        ->orWhere('full_name', 'like', '%'.strtoupper($additionalFilters['visitor_name']).'%');
                });
            }
            
            if (! empty($additionalFilters['visitor_id_detected'])) {
                $query->where(function ($query) use ($additionalFilters) {
                    $query->where('visitor_id_detected',$additionalFilters['visitor_id_detected']);
                });
            }

        } elseif ($type === 'school') {
            $query = SchoolSecurityVisitor::where('added_by', $building_id);

            if (! empty($additionalFilters['date_today'])) {
                $query->whereDate('date', Carbon::today());
            }

            if (! empty($additionalFilters['out_time_check'])) {
                $currentTime = Carbon::now();
                $query->where(function ($q) use ($currentTime) {
                    $q->whereNull('out_time')
                        ->orWhere('out_time', '>', $currentTime);
                });
            }

            if (! empty($additionalFilters['out_time_remark'])) {
                $query->whereNull('out_time_remark');
            }
            if (! empty($additionalFilters['visitor_name'])) {
                $query->where('visitor_name', 'like', '%'.$additionalFilters['visitor_name'].'%');
            }
            
            if (! empty($additionalFilters['visitor_id_detected'])) {
                $query->where(function ($query) use ($additionalFilters) {
                    $query->where('visitor_id_detected',$additionalFilters['visitor_id_detected']);
                });
            }
            
            if (! empty($dateRange) && count($dateRange) === 2 && $dateRange[0] && $dateRange[1]) {
                $query->whereBetween('date', $dateRange);
            }
        }
        // dd($query->get());
        return $query;

     
    }

    private function paginateResponse($query, $perPage, $status_of_visitor, $additionalMeta = [])
    {
        $result = $query->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $result->items(),
            'status_of_visitor' => $status_of_visitor,
            'pagination' => [
                'current_page' => $result->currentPage(),
                'last_page' => $result->lastPage(),
                'per_page' => $result->perPage(),
                'total' => $result->total(),
            ],
            'meta' => array_merge([
                'timestamp' => now(),
                'filters_used' => $additionalMeta['filters_used'] ?? [],
                'date_range' => $additionalMeta['date_range'] ?? null,
            ], $additionalMeta),
        ], 200);
    }

    public function getCurrentVisitors(Request $request)
    {
        try {
            $request->validate([
                'building_id' => 'required|integer',
                'type' => 'required|string|in:building,school',
                'user_type' => 'required|string|in:security,tenant',
                'tenant_flat_id' => 'nullable|string',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'per_page' => 'nullable|integer|min:1|max:100',
                'visitor_name' => 'nullable|string',
                'visitor_id_detected' => 'nullable|integer',
            ]);
            $building_id = $request->input('building_id');
            $type = $request->input('type');
            $user_type = $request->input('user_type');
            $tenant_flat_id = $request->input('tenant_flat_id');    
            $perPage = $request->input('per_page', 10);
            $dateRange = [$request->input('start_date'), $request->input('end_date')];
            $visitorName = $request->input('visitor_name');
            $visitor_id_detected = $request->input('visitor_id_detected');
            

            $additionalFilters = [
                'out_time_remark' => true,
                'visitor_name' => $visitorName,
                'visitor_id_detected'=>$visitor_id_detected,
            ];
            if ($user_type === 'tenant') {
                $additionalFilters['tenant_flat_office_no'] = $tenant_flat_id;

            }

            if ($type === 'school') {
                $additionalFilters['date_today'] = true;
                $additionalFilters['out_time_check'] = true;

            }

            $query = $this->getVisitorsQuery($type, $building_id, $additionalFilters, $dateRange)
                ->orderBy('created_at', 'desc');
            
               $status_od_visitor = [
                ''=>'Pending',
                '1' => 'Approved',
                '2' => 'Rejected',
                '3' => 'Reschedule'
                ];
            return $this->paginateResponse($query, $perPage,$status_od_visitor, [
                'filters_used' => $additionalFilters,
                'date_range' => $dateRange,
                'status_od_visitor'=>$status_od_visitor
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getAllVisitorsLog(Request $request)
    {
        try {
            $request->validate([
                'building_id' => 'required|integer',
                'type' => 'required|string|in:building,school',
                'start_date' => 'nullable|date',
                'end_date' => 'nullable|date',
                'per_page' => 'nullable|integer|min:1|max:100',
                'visitor_name' => 'nullable|string',
                'visitor_id_detected' => 'nullable|integer',
            ]);

            $building_id = $request->input('building_id');
            $type = $request->input('type');
            $dateRange = [$request->input('start_date'), $request->input('end_date')];
            $perPage = $request->input('per_page', 10);
            $visitorName = $request->input('visitor_name');
            $visitor_id_detected = $request->input('visitor_id_detected');
            
            $additionalFilters = [
                'not_out_time_remark' => true,
                'visitor_name' => $visitorName,
                'visitor_id_detected'=>$visitor_id_detected,
            ];
            $query = $this->getVisitorsQuery($type, $building_id, $additionalFilters, $dateRange)
                ->orderBy('created_at', 'desc');
            $status_od_visitor = [
                ''=>'Pending',
                '1' => 'Approved',
                '2' => 'Rejected',
                '3' => 'Reschedule'
                ];
            return $this->paginateResponse($query, $perPage, $status_od_visitor,[
                'filters_used' => $additionalFilters,
                'date_range' => $dateRange
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation Error',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function getSectionsByClass(Request $request)
    {
        $class = $request->input('class'); 
    
        if (is_null($class)) {
            return response()->json([
                'success' => false,
                'message' => 'Class parameter is missing or null.',
            ]);
        }
    
        $sections = SchoolStudents::where('class', $class)->select('section')->distinct()->get();
    
        return response()->json([
            'success' => true,
            'message' => 'Sections retrieved successfully.',
            'data' => $sections,
        ]);
    }
    

    public function getStudentsBySection(Request $request)
    {
        $section = $request->input('section');
// dd($section);
        if (is_null($section)) {
            return response()->json([
                'success' => false,
                'message' => 'Section parameter is missing or null.',
            ]);
        }
    
        $students = SchoolStudents::where('section', $section)->select('name')->get();
    
        return response()->json([
            'success' => true,
            'message' => 'Students retrieved successfully.',
            'data' => $students,
        ]);
    }


    public function getTenant(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'building_id' => 'required|exists:building_master,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
                $building_id = $request->input('building_id');

            $tenants = BuildingAdminTenant::select('*')
                ->where('building_id', $building_id);

            if ($request->has('contact_person')) {
                $tenants->where('contact_person', 'like', '%' . $request->input('contact_person') . '%');
            }

            $tenants = $tenants->get();
            // dd($tenants);
        
            if ($tenants->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No tenants found for the specified building.',
                    'data' => [],
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Tenants retrieved successfully.',
                'data' => $tenants,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching tenants.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}
