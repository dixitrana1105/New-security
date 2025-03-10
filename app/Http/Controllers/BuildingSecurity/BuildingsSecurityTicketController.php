<?php

namespace App\Http\Controllers\BuildingSecurity;
use App\Http\Controllers\Controller;
use App\Models\BuildingAdminTicket;
use App\Models\BuildingAdminTicketFollow;
use App\Models\BuildingTenantTicket;
use App\Models\BuildingAdminTenant;
use App\Models\SchoolAdminTicket;
use App\Models\BuildingSecurityTicket;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BuildingsSecurityTicketController extends Controller
{
    public function dashboard()
    {
        // dd('ok');
        $new_tickets = BuildingAdminTicket::where('role', 'building_security')->whereNull('status_of_button')->count() +
        SchoolAdminTicket::where('role', 'security')->whereNull('status_of_button')->count() +
        BuildingTenantTicket::where('role', 'security')->whereNull('status_of_button')->count();

// Count tickets with status = 0 (Open)
        $open_tickets = BuildingAdminTicket::where('role', 'building_security')->where('status_of_button', 0)->count() +
        SchoolAdminTicket::where('role', 'security')->where('status_of_button', 0)->count() +
        BuildingTenantTicket::where('role', 'security')->where('status_of_button', 0)->count();

// Count tickets with status = 1 (Hold)
        $hold_tickets = BuildingAdminTicket::where('role', 'building_security')->where('status_of_button', 1)->count() +
        SchoolAdminTicket::where('role', 'security')->where('status_of_button', 1)->count() +
        BuildingTenantTicket::where('role', 'security')->where('status_of_button', 1)->count();

// Count tickets with status = 2 (Close)
        $close_tickets = BuildingAdminTicket::where('role', 'building_security')->where('status_of_button', 2)->count() +
        SchoolAdminTicket::where('role', 'security')->where('status_of_button', 2)->count() +
        BuildingTenantTicket::where('role', 'security')->where('status_of_button', 2)->count();

// Count all security tickets
        $my_tickets = BuildingSecurityTicket::count();

// Display results
        $data = [
            'new_tickets'   => $new_tickets,
            'open_tickets'  => $open_tickets,
            'hold_tickets'  => $hold_tickets,
            'close_tickets' => $close_tickets,
            'my_tickets'    => $my_tickets,
            'total_tickets' => $new_tickets + $open_tickets + $hold_tickets + $close_tickets + $my_tickets,
        ];
        return view('building-security.ticket.ticket-dashboard', compact('data'));
    }

    public function new_ticket()
    {
        $ticket_data_1 = BuildingAdminTicket::with('followUps')
            ->get()
            ->sortByDesc('created_at');

        $get_all_ticket_new = BuildingAdminTicket::with('building')
            ->where('role', 'building_security')
            ->where('status_of_button', null)
            ->get();

        $get_all_ticket_new_from_school = SchoolAdminTicket::with('building', 'followUps')
            ->where('role', 'security')
            ->where('status_of_button', null)
            ->get();

            $get_all_ticket_new_from_tenant = BuildingTenantTicket::with('building', 'followUps')
            ->where('role', 'security')
            ->where('status_of_button', null)
            ->get();

            // dd($get_all_ticket_new_from_tenant);

        $ticket_data = $get_all_ticket_new_from_school->merge($ticket_data_1)->merge($get_all_ticket_new_from_tenant);

        return view('building-security.ticket.newticket', compact('get_all_ticket_new_from_tenant','get_all_ticket_new', 'ticket_data', 'get_all_ticket_new_from_school'));
    }

    public function open_ticket()
    {
        $ticket_data_1 = BuildingAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_security')->where('status_of_button', 0)->get();
        $get_all_ticket_new_from_school = SchoolAdminTicket::with('building', 'followUps')
        ->where('role', 'security')
        ->where('status_of_button', 0)
        ->get();

        $get_all_ticket_new_from_tenant = BuildingTenantTicket::with('building', 'followUps')
        ->where('role', 'security')
        ->where('status_of_button', 0)
        ->get();


        // dd($get_all_ticket_new_from_tenant);
        $ticket_data = $get_all_ticket_new_from_school->merge($ticket_data_1);
        $ticket_data = $ticket_data->merge($get_all_ticket_new_from_tenant);


        return view('building-security.ticket.openticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_new_from_school', 'get_all_ticket_new_from_tenant'));
    }

    public function hold_ticket()
    {
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_security')->where('status_of_button', 1)->get();
        $ticket_data_1 = BuildingAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_new_from_school = SchoolAdminTicket::with('building', 'followUps')
        ->where('role', 'security')
        ->where('status_of_button', 1)
        ->get();
        $get_all_ticket_new_from_tenant = BuildingTenantTicket::with('building', 'followUps')
        ->where('role', 'security')
        ->where('status_of_button', 1)
        ->get();


        // dd($get_all_ticket_new_from_tenant);
        $ticket_data = $get_all_ticket_new_from_school->merge($ticket_data_1);
        $ticket_data = $ticket_data->merge($get_all_ticket_new_from_tenant);
        return view('building-security.ticket.holdticket',compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_new_from_school', "get_all_ticket_new_from_tenant"));
    }


    public function close_ticket()
    {
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'building_security')->where('status_of_button', 2)->get();
        $ticket_data_1 = BuildingAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_new_from_school = SchoolAdminTicket::with('building', 'followUps')
        ->where('role', 'security')
        ->where('status_of_button', 2)
        ->get();

  $get_all_ticket_new_from_tenant = BuildingTenantTicket::with('building', 'followUps')
        ->where('role', 'security')
        ->where('status_of_button', 2)
        ->get();


        // dd($get_all_ticket_new_from_tenant);
        $ticket_data = $get_all_ticket_new_from_school->merge($ticket_data_1);
        $ticket_data = $ticket_data->merge($get_all_ticket_new_from_tenant);
          return view('building-security.ticket.closeticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_new_from_school', 'get_all_ticket_new_from_tenant'));
    }

    public function create_MyTicket()
    {
         $building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

        // dd($building_id);



        $lastTicket = BuildingSecurityTicket::where('ticket_id', 'like', 'BST' . $building_id . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTicket) {
            $lastNumber = intval(substr($lastTicket->ticket_id, strlen('BST' . $building_id)));
            $nextIndex = $lastNumber + 1;
        } else {
            $nextIndex = 1;
        }

        $ticketId = 'BST' . $building_id . str_pad($nextIndex, 4, '0', STR_PAD_LEFT);
        return view('building-security.ticket.myTicket-create', compact('ticketId'));
    }

    public function index_MyTicket()
    {
        $ticket_data = BuildingSecurityTicket::with('followUps')->get()->sortByDesc('created_at');

        // dd($ticket_data);

        return view('building-security.ticket.myTicket-index', compact('ticket_data'));
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

            $building_id = Auth::guard('buildingSecutityadmin')->user()->building_id;

            // dd($building_id);


            // dd()

            $ticket = BuildingSecurityTicket::create([
                // 'building_id' => $building_id,
                'ticket_id'   => $validatedData['ticket_id'],
                'date_time'   => $validatedData['date_time'],
                'subject'     => $validatedData['subject'],
                'role'        => $validatedData['role'],
                'attachment'  => $attachmentPath,
                'building_id'  => $building_id,
                'description' => $validatedData['description'],
                'added_by' => Auth::guard('buildingSecutityadmin')->user()->id,
                'created_at'  => now(),
            ]);

            return redirect()->route('building-security.myTicket-index')->with('success', 'Ticket created successfully.');

    }
}
