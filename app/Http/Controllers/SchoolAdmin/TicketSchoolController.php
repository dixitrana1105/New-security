<?php

namespace App\Http\Controllers\SchoolAdmin;
use App\Http\Controllers\Controller;
use App\Models\SchoolAdminTicket;
use App\Models\SchoolAdminSecurity;
use App\Models\SchoolSecurityTicket;
use App\Models\SchoolSecurityVisitor;
use App\Models\SuperAdminTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TicketSchoolController extends Controller
{
    public function closeticket_school()
    {
        $get_all_ticket_new = SuperAdminTicket::with('building')->where('role', 'school_admin')->where('status_of_button', 2)->get();
        $ticket_data_1 = SuperAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_from_school_secutity = SchoolSecurityTicket::with('building')->where('role', 'school_admin')->where('status_of_button', 2)->get();

        $ticket_data = $get_all_ticket_from_school_secutity->merge($ticket_data_1);
        return view('school-admin.ticket.closeticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_from_school_secutity' ));
    }

    public function openticket_school()
    {
        $ticket_data_1 = SuperAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_new = SuperAdminTicket::with('building')->where('role', 'school_admin')->where('status_of_button', 0)->get();
        $get_all_ticket_from_school_secutity = SchoolSecurityTicket::with('building')->where('role', 'school_admin')->where('status_of_button', 0)->get();

        $ticket_data = $get_all_ticket_from_school_secutity->merge($ticket_data_1);
        return view('school-admin.ticket.openticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_from_school_secutity'));
    }

    public function holdticket_school()
    {
        $get_all_ticket_new = SuperAdminTicket::with('building')->where('role', 'school_admin')->where('status_of_button', 1)->get();
        $ticket_data = SuperAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_from_school_secutity = SchoolSecurityTicket::with('building')->where('role', 'school_admin')->where('status_of_button', 1)->get();

        $ticket_data = $get_all_ticket_from_school_secutity->merge($ticket_data);
        return view('school-admin.ticket.holdticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_from_school_secutity'));
    }

    public function newticket_school()
    {
        $ticket_data_1 = SuperAdminTicket::

        with('followUps')
        ->get()
        ->sortByDesc('created_at');
    $get_all_ticket_new = SuperAdminTicket::with('building')->where('role', 'school_admin')->where('status_of_button', null)->get();

    $get_all_ticket_from_school_secutity = SchoolSecurityTicket::with('building')->where('role', 'school_admin')->where('status_of_button', null)->get();

$ticket_data = $get_all_ticket_from_school_secutity->merge($ticket_data_1);
        return view('school-admin.ticket.newticket', compact('get_all_ticket_new', 'get_all_ticket_from_school_secutity', 'ticket_data','get_all_ticket_from_school_secutity'));
    }

    public function myticket_school_index()
    {

        $ticket_data = SchoolAdminTicket::where('added_by', Auth::guard('buildingadmin')
        ->user()->id)
        ->get()
        ->sortByDesc('created_at');

        return view('school-admin.ticket.myticket.index', compact('ticket_data'));
    }

    public function myticket_school_create()
    {
        $building_id = Auth::guard('buildingadmin')->user()->id;

        $lastTicket = SchoolAdminTicket::where('ticket_id', 'like', 'SAT' . $building_id . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTicket) {
            $lastNumber = intval(substr($lastTicket->ticket_id, strlen('SAT' . $building_id)));
            $nextIndex = $lastNumber + 1;
        } else {
            $nextIndex = 1;
        }

        $ticketId = 'SAT' . $building_id . str_pad($nextIndex, 4, '0', STR_PAD_LEFT);
        return view('school-admin.ticket.myticket.create', compact('ticketId'));
    }

    public function dashboard()
    {
        $schoolSecurityOpen  = SchoolSecurityTicket::where('role', 'school_admin')->where('status_of_button', 0)->count();
        $schoolSecurityHold  = SchoolSecurityTicket::where('role', 'school_admin')->where('status_of_button', 1)->count();
        $schoolSecurityClose = SchoolSecurityTicket::where('role', 'school_admin')->where('status_of_button', 2)->count();
        $schoolSecurityNull  = SchoolSecurityTicket::where('role', 'school_admin')->whereNull('status_of_button')->count();

        $superAdminOpen  = SuperAdminTicket::where('role', 'school_admin')->where('status_of_button', 0)->count();
        $superAdminHold  = SuperAdminTicket::where('role', 'school_admin')->where('status_of_button', 1)->count();
        $superAdminClose = SuperAdminTicket::where('role', 'school_admin')->where('status_of_button', 2)->count();
        $superAdminNull  = SuperAdminTicket::where('role', 'school_admin')->whereNull('status_of_button')->count();

        $schoolAdminTicketCount = SchoolAdminTicket::where('added_by', Auth::guard('buildingadmin')->user()->id)->count();

        $totalTickets = $schoolSecurityOpen + $schoolSecurityHold + $schoolSecurityClose + $schoolSecurityNull +
            $superAdminOpen + $superAdminHold + $superAdminClose + $superAdminNull +
            $schoolAdminTicketCount;

        $data = [
            'Open'                 => $schoolSecurityOpen + $superAdminOpen,
            'Hold'                 => $schoolSecurityHold + $superAdminHold,
            'Close'                => $schoolSecurityClose + $superAdminClose,
            'New'                 => $schoolSecurityNull + $superAdminNull,
            'School Admin Tickets' => $schoolAdminTicketCount,
            'Total Tickets'        => $totalTickets,
        ];
        return view('school-admin.ticket.dashboard', compact('data'));
    }


    public function store_MyTicket(Request $request)
    {

        // dd($request);
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
            // $building_id = Auth::guard('buildingadmin')->user()->id;
            // $building_id = Auth::guard('buildingadmin')->user()->building_id;

            // dd(Auth::guard('buildingadmin')->user());


            // dd()

            $ticket = SchoolAdminTicket::create([
                // 'building_id' => $building_id,
                'ticket_id'   => $validatedData['ticket_id'],
                'date_time'   => $validatedData['date_time'],
                'subject'     => $validatedData['subject'],
                'role'        => $validatedData['role'],
                'attachment'  => $attachmentPath,
                'building_id'  => $building_id ?? null,
                'description' => $validatedData['description'],
                'added_by' => Auth::guard('buildingadmin')->user()->id,
                'created_at'  => now(),
            ]);

            return redirect()->route('school-admin.my-ticket-index')->with('success', 'School Ticket created successfully.');

    }
}
