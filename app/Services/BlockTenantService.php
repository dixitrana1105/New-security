<?php

namespace App\Services;

use App\Models\BlockVisitor;
use App\Models\BuildingAdminTenant;
use App\Models\BuildingTenant;
use App\Models\Visitor_Master;
use App\Models\TenantVisitor;
use App\Models\SchoolSecurityVisitor;
use App\Models\SchoolSecurityBlock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BlockTenantService
{
    public function blockTenant($request)
    {
        // Validate incoming request data
        $request->validate([
            'visitor_id' => 'required',
            'tenant_id' => 'required',
            'block_tenant_remark' => 'required', 
        ]);

        // Extract visitor ID
        $visitorId = $request->visitor_id;

        $table_id = TenantVisitor::where('visitor_id', $visitorId)->value('id');


        // Create new BlockVisitor instance
        $data = new BlockVisitor();
        $data->visitor_id = $request->visitor_id;
        $data->table_id = $table_id;
        $data->tenant_id = $request->tenant_id;
        $data->block_tenant_remark = $request->block_tenant_remark;
        $data->block_from = 1;
        $data->added_by = Auth::guard('buildingtenant')->user()->id;
        $data->building_id = Auth::guard('buildingtenant')->user()->building_id;
        $data->created_at = now();

        // Save the block visitor record
        $data->save();

        // Update TenantVisitor
        TenantVisitor::where('visitor_id', $visitorId)->update(['tenant_block' => 1]);

        return ['success' => true, 'message' => 'Visitor blocked successfully.'];
    }


    // public function blockSecurity($request)
    // {
    //     // Validate incoming request data
    //     $request->validate([
    //         'visitor_id' => 'required',
    //         'tenant_id' => 'required',
    //         'block_tenant_remark' => 'required', 
    //     ]);

    //     // Extract visitor ID
    //     $visitorId = $request->visitor_id;

    //     // Create new BlockVisitor instance
    //     $data = new BlockVisitor();
    //     $data->visitor_id = $request->visitor_id;
    //     $data->tenant_id = $request->tenant_id;
    //     $data->block_tenant_remark = $request->block_tenant_remark;
    //     $data->block_from = 0;
    //     $data->added_by = Auth::guard('buildingSecutityadmin')->user()->id;
    //     $data->building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;
    //     $data->created_at = now();

    //     $data->save();

    //     // dd($visitorId);

    //     Visitor_Master::where('visitor_id', $visitorId)->update(['tenant_block' => 1]);

    //     return ['success' => true, 'message' => 'Visitor blocked successfully.'];   
    // }

    public function blockSecurity($request)
    {
        $request->validate([
            'visitor_id' => 'required',
            'tenant_id' => 'required',
            'block_tenant_remark' => 'required', 
        ]);

        $visitorId = $request->visitor_id;

        $table_id = Visitor_Master::where('visitor_id', $visitorId)->value('id');

        // dd($table_id);

        $data = new BlockVisitor();
        $data->visitor_id = $request->visitor_id;
        $data->table_id = $table_id;
        $data->tenant_id = $request->tenant_id;
        $data->block_tenant_remark = $request->block_tenant_remark;
        $data->block_from = 0;
        $data->added_by = Auth::guard('buildingSecutityadmin')->user()->id;
        $data->building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;
        $data->created_at = now();

        $data->save();

        // dd($visitorId);

        Visitor_Master::where('visitor_id', $visitorId)->update(['tenant_block' => 1]);

        return ['success' => true, 'message' => 'Visitor blocked successfully.'];   
    }


    public function saveAction($request)
    {
        $request->validate([
            'id' => 'required|integer',
            'actionType' => 'required|string',
            'proveRemark' => 'nullable|string',
            'rejectRemark' => 'nullable|string',
            'resedualRemark' => 'nullable|string',
            'resedualDate' => 'nullable|date',
        ]);
    
        $record = Visitor_Master::find($request->input('id'));
    
        if (!$record) {
            return response()->json(['message' => 'Record not found!'], 404);
        }
    
        $actionType = $request->input('actionType');
    
        switch ($actionType) {
            case 'prove remark':
                $proveRemark = $request->input('proveRemark');
                $record->status_of_visitor = 0;
                $record->visitor_remark = $proveRemark; 
                break;
    
            case 'reject remark':
                $rejectRemark = $request->input('rejectRemark');
                $record->status_of_visitor = 1;
                $record->visitor_remark = $rejectRemark;
                break;
    
            case 'resedual remark and date':
                $resedualRemark = $request->input('resedualRemark');
                $resedualDate = $request->input('resedualDate');
                $record->status_of_visitor = 2;
                $record->visitor_remark = $resedualRemark; 
                $record->reschedule_date = $resedualDate; 
                break;
    
            default:
                return response()->json(['message' => 'Invalid action type!'], 400);
        }
    
        $record->save();
    
        return response()->json(['message' => 'Data saved successfully!'], 200);
        
    }



    public function saveActionforTenant($request)
    {
        // dd($request);
        $request->validate([
            'id' => 'required|integer',
            'actionType' => 'required|string',
            'proveRemark' => 'nullable|string',
            'rejectRemark' => 'nullable|string',
            'resedualRemark' => 'nullable|string',
            'resedualDate' => 'nullable|date',
            'subTenantId' => 'nullable',
        ]);

        // dd($request->subTenantId);
    
        $record = Visitor_Master::find($request->input('id'));
    
        if (!$record) {
            return response()->json(['message' => 'Record not found!'], 404);
        }
    
        $actionType = $request->input('actionType');
    
        switch ($actionType) {
            case 'prove remark':
                $proveRemark = $request->input('proveRemark');
                $record->status_of_visitor = 0;
                $record->subtenant_id_tenant_block = $request->subTenantId;
                $record->visitor_remark = $proveRemark; 
                break;
    
            case 'reject remark':
                $rejectRemark = $request->input('rejectRemark');
                $record->status_of_visitor = 1;
                $record->subtenant_id_tenant_block = $request->subTenantId;
                $record->visitor_remark = $rejectRemark;
                break;
    
            case 'resedual remark and date':
                $resedualRemark = $request->input('resedualRemark');
                $resedualDate = $request->input('resedualDate');
                $record->subtenant_id_tenant_block = $request->subTenantId;
                $record->status_of_visitor = 2;
                $record->visitor_remark = $resedualRemark; 
                $record->reschedule_date = $resedualDate; 
                break;
    
            default:
                return response()->json(['message' => 'Invalid action type!'], 400);
        }

        // dd($record);
    
        $record->save();
    
        return response()->json(['message' => 'Data saved successfully!'], 200);
        
    }

    public function blockSchoolVisitor(Request $request)
    {
        $validated = $request->validate([
            'visitor_id' => 'required',
            'block_visitor_remark' => 'required',
        ]);
    
        
        $visitorId = $validated['visitor_id'];

        $visitor = SchoolSecurityVisitor::where('visitor_id',$visitorId)->first();
        $blockedById = Auth::guard('schoolsecurity')->user()->id;

        SchoolSecurityBlock::create([
            'visitor_id' => $visitor->visitor_id,
            'remark' => $request->block_visitor_remark,
            'date' => $visitor->date,
            'photo' => $visitor->photo,
            'visitor_name' => $visitor->visitor_name,
            'class' => $visitor->class,
            'section' => $visitor->section,
            'student_name' => $visitor->student_name,
            'mobile' => $visitor->mobile,
            'whatsapp' => $visitor->whatsapp,
            'email' => $visitor->email,
            'blocked_by' => $blockedById,
            'id_proof' => $visitor->id_proof,
        ]);   


        $visitor->update(['visitor_block' => 1]);

        return ['success' => true, 'message' => 'Visitor blocked successfully.'];   
    }
}
