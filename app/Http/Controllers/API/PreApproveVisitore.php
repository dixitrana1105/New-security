<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TenantVisitor;
use App\Models\Visitor_Master;
use Illuminate\Http\Request;

class PreApproveVisitore extends Controller
{

    public function preStoreVisitor(Request $request)
    {
        // dd('ok');
        $validatedData = $request->validate([
            'tenant_flat_office_no' => '',
            'VisitorId'             => '',
            'visitor_id'            => 'nullable',
            'date'                  => '',
            'full_name'             => '',
            'in_time'               => '',
            'out_time'              => 'nullable',
            'visiter_purpose'       => '',
            'photo'                 => 'nullable',
            'id_proof'              => 'nullable',
            'mobile'              => 'nullable',
            'whatsapp'              => 'nullable',

        ]);

        // dd($request->all());

        $destinationPath = public_path('assets/images/');
        $idProofPath     = null;
        $photoPath       = null;

        if ($request->file('id_proof')) {
            $idProofFileName = time() . '_' . $request->file('id_proof')->getClientOriginalName();
            $request->file('id_proof')->move($destinationPath, $idProofFileName);
            $idProofPath = 'assets/images/' . $idProofFileName;
        }

        if ($request->file('photo')) {
            $photoFile = time() . '_' . $request->file('photo')->getClientOriginalName();
            $request->file('photo')->move($destinationPath, $photoFile);
            $photoPath = 'assets/images/' . $photoFile;
        }

        // Create and save visitor data
        $visitorData = Visitor_Master::create([
            'tenant_flat_office_no'          => $validatedData['tenant_flat_office_no'],
            'visitor_id'                     => $validatedData['VisitorId'],
            'date'                           => $validatedData['date'],
            'full_name'                      => $validatedData['full_name'],
            'mobile'                      => $validatedData['mobile'],
            'whatsapp'                      => $validatedData['whatsapp'],
            'in_time'                        => now(),
            'visitor_remark'                 => 'Preapproved',
            'pre_approve_tenant_visitore_id' => $validatedData['VisitorId'],
            'out_time'                       => $validatedData['out_time'] ?? null,
            'visitor_id_detected'            => $validatedData['visitor_id'] ?? null,
            'visiter_purpose'                => $validatedData['visiter_purpose'],
            'building_id'                    => $request->building_id,
            'status'                         => 1,
            'photo'                          => $photoPath,
            'id_proof'                       => $idProofPath,
            'added_by' => $request->building_id,
            'created_at'                     => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Visitor data successfully saved.',
            'data'    => $visitorData,
        ], 201);
    }

/**
 * Handle Base64 image upload and save to the destination path.
 *
 * @param string $base64Image
 * @param string $destinationPath
 * @param string $prefix
 * @return string|null
 */
    private function handleBase64Upload($base64Image, $destinationPath, $prefix)
    {
        $imageParts = explode(';base64,', $base64Image);

        if (count($imageParts) === 2) {
            $imageTypeAux = explode('image/', $imageParts[0]);
            $imageType    = $imageTypeAux[1] ?? 'png';
            $imageBase64  = base64_decode($imageParts[1]);
            $fileName     = time() . "_{$prefix}." . $imageType;

            if (! file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            file_put_contents($destinationPath . $fileName, $imageBase64);
            return 'assets/images/' . $fileName;
        }

        return null;
    }

    public function getPreapproveVisitore($building_id)
    {
        $visitorMasterIds = Visitor_Master::where('building_id', $building_id)->pluck('visitor_id');

        $visitors = TenantVisitor::where('building_id', $building_id)
            ->whereNotIn('visitor_id', $visitorMasterIds)
            ->get(['full_name', 'visitor_id']);

        return response()->json($visitors);
    }

}
