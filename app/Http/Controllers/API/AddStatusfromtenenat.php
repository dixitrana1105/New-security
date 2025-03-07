<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Visitor_Master;
use Illuminate\Http\Request;

class AddStatusfromtenenat extends Controller
{

    public function addStatusVisitor(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'type' => 'required|string|in:building_admin',
                'building_id' => 'required|string',
                'visitor_id' => 'required|exists:visitor_master,visitor_id',
                'actionType' => 'required|string|in:prove remark,reject remark,resedual remark and date',
                'proveRemark' => 'nullable|string',
                'rejectRemark' => 'nullable|string',
                'resedualRemark' => 'nullable|string',
                'resedualDate' => 'nullable|date',
            ]);

            $record = Visitor_Master::where('visitor_id', $validatedData['visitor_id'])->first();


            if (!$record) {
                return response()->json(['error' => 'Visitor record not found.'], 404);
            }

            $actionType = $validatedData['actionType'];

            switch ($actionType) {
                case 'prove remark':
                    if (empty($validatedData['proveRemark'])) {
                        return response()->json(['error' => 'Prove remark is required for this action.'], 422);
                    }
                    $record->status_of_visitor = 0;
                    $record->visitor_remark = $validatedData['proveRemark'];
                    break;

                case 'reject remark':
                    if (empty($validatedData['rejectRemark'])) {
                        return response()->json(['error' => 'Reject remark is required for this action.'], 422);
                    }
                    $record->status_of_visitor = 1;
                    $record->visitor_remark = $validatedData['rejectRemark'];
                    break;

                case 'resedual remark and date':
                    if (empty($validatedData['resedualRemark']) || empty($validatedData['resedualDate'])) {
                        return response()->json(['error' => 'Both resedual remark and date are required for this action.'], 422);
                    }
                    $record->status_of_visitor = 2;
                    $record->visitor_remark = $validatedData['resedualRemark'];
                    $record->reschedule_date = $validatedData['resedualDate'];
                    break;

                default:
                    return response()->json(['error' => 'Invalid action type.'], 400);
            }

            $record->save();

            return response()->json(['message' => 'Data saved successfully.'], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An unexpected error occurred.', 'details' => $e->getMessage()], 500);
        }
    }


}
