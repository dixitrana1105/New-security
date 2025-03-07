<?php

namespace App\Http\Controllers\BuildingTenant;
use App\Http\Controllers\Controller;
use App\Models\BuildingTenantTicket;
use App\Models\BuildingAdminTicketFollow;
use App\Models\BuildingAdminTicket;
use App\Models\BuildingSecurityTicket;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BuildingsTenantTicketController extends Controller
{
    public function dashboard()
    {
        // dd('ok');
        return view('building-tenant.ticket.ticket-dashboard');
    }

    public function new_ticket()
    {
        $ticket_data_1 = BuildingAdminTicket::

        with('followUps')
        ->get()
        ->sortByDesc('created_at');
    $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', null)->get();
    $get_all_ticket_new = BuildingTenantTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', null)->get();
        // dd($get_all_ticket_new);
        $get_all_ticket_from_security = BuildingSecurityTicket::with('building', 'followUps')->where('role', 'building_tenant')->where('status_of_button', null)->get();

$ticket_data = $get_all_ticket_from_security->merge($ticket_data_1);
        return view('building-tenant.ticket.newticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_from_security'));
    }

    public function open_ticket()
    {
        $ticket_data_1 = BuildingAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 0)->get();
        $get_all_ticket_from_security = BuildingSecurityTicket::with('building', 'followUps')->where('role', 'building_tenant')->where('status_of_button', 0)->get();

        $ticket_data = $get_all_ticket_from_security->merge($ticket_data_1);
        return view('building-tenant.ticket.openticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_from_security'));
    }

    public function hold_ticket()
    { $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 1)->get();
        $ticket_data_1 = BuildingAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_from_security = BuildingSecurityTicket::with('building', 'followUps')->where('role', 'building_tenant')->where('status_of_button', 1)->get();

        $ticket_data = $get_all_ticket_from_security->merge($ticket_data_1);
        return view('building-tenant.ticket.holdticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_from_security'));
    }

    public function close_ticket()
    {
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_tenant')->where('status_of_button', 2)->get();
        $ticket_data_1 = BuildingAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_from_security = BuildingSecurityTicket::with('building', 'followUps')->where('role', 'building_tenant')->where('status_of_button', 2)->get();

        $ticket_data = $get_all_ticket_from_security->merge($ticket_data_1);
        return view('building-tenant.ticket.closeticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_from_security'));
    }

    public function create_MyTicket()
    {

        // $building_id = Auth::guard('buildingadmin')->user()->id;

        $building_id = Auth::guard('buildingtenant')->user()->building_id;

        // dd($building_id);



        $lastTicket = BuildingTenantTicket::where('ticket_id', 'like', 'BATT' . $building_id . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTicket) {
            $lastNumber = intval(substr($lastTicket->ticket_id, strlen('BATT' . $building_id)));
            $nextIndex = $lastNumber + 1;
        } else {
            $nextIndex = 1;
        }

        $ticketId = 'BATT' . $building_id . str_pad($nextIndex, 4, '0', STR_PAD_LEFT);
        return view('building-tenant.ticket.myTicket-create', compact('ticketId'));
    }

    public function index_MyTicket()
    {
        $ticket_data = BuildingTenantTicket::where('added_by', Auth::guard('buildingtenant')
        ->user()->id)
        ->with('followUps')
        ->get()
        ->sortByDesc('created_at');

        // dd($ticket_data);
        return view('building-tenant.ticket.myTicket-index', compact('ticket_data'));
    }


    public function store_MyTicket(Request $request)
    {

            $validatedData = $request->validate([
                'ticket_id'   => 'required|string|max:255',
                'date_time'   => 'required|date',
                'subject'     => 'required|string|max:255',
                'role'        => 'required|string|max:50',
                'attachment'  => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'description' => 'required|string',
            ]);



            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $destinationPath = public_path('assets/images/');
                $attachmentFileName = time() . '_' . $request->file('attachment')->getClientOriginalName();
                $request->file('attachment')->move($destinationPath, $attachmentFileName);
                $attachmentPath = 'assets/images/' . $attachmentFileName;
            }
            // $id = Auth::guard('buildingtenant')->user()->id;

            // dd($id);

            $building_id = Auth::guard('buildingtenant')->user()->building_id;

            // dd($building_id);


            // dd()

            $ticket = BuildingTenantTicket::create([
                // 'building_id' => $building_id,
                'ticket_id'   => $validatedData['ticket_id'],
                'date_time'   => $validatedData['date_time'],
                'subject'     => $validatedData['subject'],
                'role'        => $validatedData['role'],
                'attachment'  => $attachmentPath,
                'building_id'  => $building_id,
                'description' => $validatedData['description'],
                'added_by' => Auth::guard('buildingtenant')->user()->id,
                'created_at'  => now(),
            ]);

            return redirect()->route('building-tenant.myTicket-index')->with('success', 'Ticket created successfully.');

    }
}
