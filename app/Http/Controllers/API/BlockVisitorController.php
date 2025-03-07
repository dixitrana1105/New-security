<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlockVisitor;
use App\Models\Visitor_Master;
use App\Models\Visitor;
use App\Models\TenantVisitor;
use App\Models\SchoolSecurityBlock;
use App\Models\TokenApi;
use App\Models\SchoolSecurityVisitor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class BlockVisitorController extends Controller
{

// public function __construct(){
//     $this->middleware('auth:schoolsecurity');
// }

    public function blockVisitor(Request $request)
    {
        try {
            // Unified validation
            $validator = Validator::make($request->all(), [
                'type' => 'required|in:building,school_security',
                'building_id' => 'required_if:type,building',
                'tenant_id' => 'required_if:type,building',
                'visitor_id' => 'required',
                'block_tenant_remark' => 'required_if:type,building',
                'block_visitor_remark' => 'required_if:type,school',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation errors occurred.',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $type = $request->type;
            $visitorId = $request->visitor_id;

            if ($type === 'building') {
                // Handle blocking visitor for a building
                $table_id = Visitor_Master::where('visitor_id', $visitorId)->value('id');
                if (!$table_id) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Visitor not found.',
                    ], 404);
                }

                // Create BlockVisitor entry
                $data = new BlockVisitor();
                $data->visitor_id = $visitorId;
                $data->table_id = $table_id;
                $data->tenant_id = $request->tenant_id;
                $data->block_tenant_remark = $request->block_tenant_remark;
                $data->block_from = 0;
                $data->added_by = $request->building_id;
                $data->building_id = $request->building_id;
                $data->created_at = now();
                $data->save();

                // Update Visitor_Master
                Visitor_Master::where('visitor_id', $visitorId)->update(['tenant_block' => 1]);

                return response()->json([
                    'success' => true,
                    'message' => 'Visitor blocked successfully in building.',
                ], 200);
            } elseif ($type === 'school_security') {
                // Handle blocking visitor for a school
                $visitor = SchoolSecurityVisitor::where('visitor_id', $visitorId)->first();
                if (!$visitor) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Visitor not found in school.',
                    ], 404);
                }
                // $currentSessionToken = Str::random(40);
                // dd($currentSessionToken);
                $blockedById = TokenApi::where('user_type', $type)->first()?->user_id;

            //   dd($blockedById->user_id);

                // Create SchoolSecurityBlock entry
                SchoolSecurityBlock::create([
                    'visitor_id' => $visitor->visitor_id,
                    'remark' => $request->block_visitor_remark,
                    'blocked_by' => $blockedById,
                ]);

                // Update SchoolSecurityVisitor
                $visitor->update(['visitor_block' => 1]);

                return response()->json([
                    'success' => true,
                    'message' => 'Visitor blocked successfully in school.',
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'Invalid type provided.',
            ], 400); // HTTP 400 Bad Request

        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while blocking the visitor.',
                'error' => $e->getMessage(),
            ], 500); // HTTP 500 Internal Server Error
        }
    }


}
