<?php

namespace App\Http\Controllers\BuildingTenant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Building_Master;
use App\Models\BuildingAdminTenant;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BuildingsTenantTenController extends Controller
{

    public function index_tenant(Request $request)
    {
        $status = $request->input('status') ?? 1;

        $user_id = Auth::guard('buildingtenant')->user()->id;
        $building_id = Auth::guard('buildingtenant')->user()->building_id;

        $query = BuildingAdminTenant::where('building_id',$building_id)->whereNot('id', $user_id);

        if ($status !== null) {
            $query->where('status', $status);
        }
        $tenant = $query->get();

        return view('building-tenant.tenant.index',compact('tenant'));
    }


    public function sendNewMessage(Request $request)
    {
        $receiver_user_type = $request->receiver_user_type ?? 'tenant';
        $validator = Validator::make($request->all(), [
            'reciever_id' => 'required',
            'sender_id' => 'required',
        ]);

        $receiver_type = null;

        if ($receiver_user_type == 'security') {
            $receiver_type = Message::RECEIVER_TYPES['security'];
        } else {
            $receiver_type = Message::RECEIVER_TYPES['tenant'];
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = null;
        $sender_type = null;

        if (Auth::guard('buildingtenant')->check()) {
            $user = Auth::guard('buildingtenant')->user();
            $sender_type = Message::SENDER_TYPES['tenant'];

        } elseif (Auth::guard('buildingSecutityadmin')->check()) {
            $user = Auth::guard('buildingSecutityadmin')->user();
            $sender_type = Message::SENDER_TYPES['security'];
        }

        if (!$user) {
            return redirect()->back()->with('error', 'Unauthorized user.');
        }

        if ($user->id != $request->input('sender_id') && $user->id == $request->input('reciever_id')) {
            return redirect()->back()->with('error', 'You cannot perform this action.');
        }

        $receiver_id = encrypt($request->reciever_id);
        $data = [
            'reciever_id' => $receiver_id,
            'sender_id' => encrypt($user->id),
            'reciever_type' =>  $receiver_type,
            'sender_type' =>  $sender_type,
            'redirect' => route('messages.new'),
        ];
        return response()->json(['status' => 200, 'data' => $data]);
    }

}