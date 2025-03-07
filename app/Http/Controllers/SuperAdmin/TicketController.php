<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\BuildingAdminTicket;
use App\Models\BuildingAdminTicketFollow;
use App\Models\BuildingTenantTicket;
use App\Models\SchoolAdminTicket;
 use App\Models\BuildingSecurityTicket;
use App\Models\SuperAdminTicket;
use App\Models\SchoolSecurityTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function dashboard()
    {
        $countStatus1 = BuildingAdminTicket::where('status_of_button', 1)->count();
        $countStatus2 = BuildingAdminTicket::where('status_of_button', 2)->count();
        $countStatus0 = BuildingAdminTicket::where('status_of_button', 0)->count();
        $countNull = BuildingAdminTicket::where('status_of_button', null)->count();
        $totalCount = BuildingAdminTicket::count();

        return view('super-admin.ticket.dashboard', compact('countStatus1', 'countStatus2', 'countStatus0', 'totalCount', 'countNull'));
    }

    public function myticket_index()
    {

        $ticket_data = SuperAdminTicket::where('added_by', Auth::guard('superadmin')
                ->user()->id)
            ->get()
            ->sortByDesc('created_at');

        return view('super-admin.ticket.myticket.index', compact('ticket_data'));
    }

    public function myticket_create()
    {
        $super_admin_id = Auth::guard('superadmin')->user()->id;

        // dd($super_admin_id);

        $lastTicket = SuperAdminTicket::where('ticket_id', 'like', 'SUPAT' . $super_admin_id . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTicket) {
            $lastNumber = intval(substr($lastTicket->ticket_id, strlen('SUPAT' . $super_admin_id)));
            $nextIndex = $lastNumber + 1;
        } else {
            $nextIndex = 1;
        }

        $ticketId = 'SUPAT' . $super_admin_id . str_pad($nextIndex, 4, '0', STR_PAD_LEFT);
        return view('super-admin.ticket.myticket.create', compact('ticketId'));
    }

    public function new_ticket()
    {
        $ticket_data_1 = BuildingAdminTicket::
            with('followUps')
            ->get()
            ->sortByDesc('created_at');
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'super_admin')->where('status_of_button', null)->get();
        $get_all_ticket_new_from_school = SchoolAdminTicket::with('building', 'followUps')
            ->where('role', 'super_admin')
            ->where('status_of_button', null)
            ->get();
        $ticket_data = $get_all_ticket_new_from_school->merge($ticket_data_1);

        // dd($get_all_ticket_new);
        return view('super-admin.ticket.newticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_new_from_school'));
    }

    public function saveDescriptionImage(Request $request)
    {

        // dd($request->image);
        // dd($request);
        // $validated = $request->validate([
        //     'description' => 'required|string|max:255',
        //     'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        //     'ticket_id' => 'required|exists:building_admin_ticket,ticket_id',
        // ]);

        // dd('ok');
        $imagePath = null;

        // dd($request->image);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('assets/images/');
            $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $imageFileName);
            $imagePath = 'assets/images/' . $imageFileName;
        }

        $ticketId = $request->input('ticket_id');
        $description = $request->input('description');

        $liveLink = $request->live_link;

        if (str_ends_with($liveLink, 'super-admin/new-ticket#')) {
            $followUpBy = 0;
        } elseif (str_ends_with($liveLink, 'building-admin/myTicket-index#')) {
            $followUpBy = 1;
        } elseif (str_ends_with($liveLink, 'building-security/new-ticket#')) {
            $followUpBy = 2;
        } elseif (str_ends_with($liveLink, 'building-tenant/new-ticket#')) {
            $followUpBy = 3;
        } elseif (str_ends_with($liveLink, 'school-admin/my-ticket-index#')) {
            $followUpBy = 4;
        } elseif (str_ends_with($liveLink, 'building-admin/new-ticket#')) {
            $followUpBy = 1;
        } elseif (str_ends_with($liveLink, 'building-tenant/myTicket-index#')) {
            $followUpBy = 3;
        } elseif (str_ends_with($liveLink, 'school-admin/new-ticket#')) {
            $followUpBy = 4;
        } elseif (str_ends_with($liveLink, 'super-admin/myTicket-index#')) {
            $followUpBy = 0;
        } elseif (str_ends_with($liveLink, 'building-security/myTicket-index#')) {
            $followUpBy = 2;

    } elseif (str_ends_with($liveLink, 'school/security/my-ticket-index#')) {
        $followUpBy = 5;
    }




        if (str_ends_with($liveLink, 'school-admin/new-ticket#')) {
            $ticket = SuperAdminTicket::where('ticket_id', $ticketId)
                ->latest('id')
                ->first();

                if (!$ticket) {
                    $ticket = SchoolSecurityTicket::where('ticket_id', $ticketId)
                        ->latest('id')
                        ->first();
                }



            if ($ticket && is_null($ticket->status_of_button)) {
                $ticket->status_of_button = 0;
                $ticket->save();
            }
        }

        if (str_ends_with($liveLink, 'super-admin/new-ticket#')) {
            $ticket = BuildingAdminTicket::where('ticket_id', $ticketId)
                ->latest('id')
                ->first();

            if (!$ticket) {
                $ticket = BuildingSecurityTicket::where('ticket_id', $ticketId)
                    ->latest('id')
                    ->first();
            }
            if (!$ticket) {
                $ticket = SchoolAdminTicket::where('ticket_id', $ticketId)
                    ->latest('id')
                    ->first();
            }


            if ($ticket && is_null($ticket->status_of_button)) {
                $ticket->status_of_button = 0;
                $ticket->save();
            }
        }

        if (str_ends_with($liveLink, 'building-security/new-ticket#')) {
            $ticket = BuildingAdminTicket::where('ticket_id', $ticketId)
                ->latest('id')
                ->first();

            if (!$ticket) {
                $ticket = SchoolAdminTicket::where('ticket_id', $ticketId)
                    ->latest('id')
                    ->first();
            }
            if (!$ticket) {
                $ticket = BuildingTenantTicket::where('ticket_id', $ticketId)
                    ->latest('id')
                    ->first();
            }




            if ($ticket && is_null($ticket->status_of_button)) {
                $ticket->status_of_button = 0;
                $ticket->save();
            }
        }

        if (str_ends_with($liveLink, 'building-tenant/new-ticket#')) {
            $ticket = BuildingAdminTicket::where('ticket_id', $ticketId)
                ->latest('id')
                ->first();


                if (!$ticket) {
                    $ticket = BuildingSecurityTicket::where('ticket_id', $ticketId)
                        ->latest('id')
                        ->first();
                }


            if ($ticket && is_null($ticket->status_of_button)) {
                $ticket->status_of_button = 0;
                $ticket->save();
            }
        }


        if (str_ends_with($liveLink, 'building-security/myTicket-index#')) {
            $ticket = BuildingSecurityTicket::where('ticket_id', $ticketId)
                ->latest('id')
                ->first();

            if ($ticket && is_null($ticket->status_of_button)) {
                $ticket->status_of_button = 0;
                $ticket->save();
            }
        }

        if (str_ends_with($liveLink, 'school/security/my-ticket-index#')) {
            $ticket = SchoolSecurityTicket::where('ticket_id', $ticketId)
                ->latest('id')
                ->first();

            if ($ticket && is_null($ticket->status_of_button)) {
                $ticket->status_of_button = 0;
                $ticket->save();
            }
        }



        if (str_ends_with($liveLink, 'building-admin/new-ticket#')) {
            $ticket = BuildingTenantTicket::where('ticket_id', $ticketId)
                ->latest('id')
                ->first();


                 if (!$ticket) {
                $ticket = BuildingSecurityTicket::where('ticket_id', $ticketId)
                    ->latest('id')
                    ->first();
            }

            if ($ticket && is_null($ticket->status_of_button)) {
                $ticket->status_of_button = 0;
                $ticket->save();
            }
        }

        // dd($followUpBy);

        BuildingAdminTicketFollow::create([
            'ticket_id' => $ticketId,
            'description' => $description,
            'image' => $imagePath,
            'follow_up_by' => $followUpBy,
            'created_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Data saved successfully.']);
    }

    public function getReply($ticket_id)
    {
        $ticket = BuildingAdminTicket::where('ticket_id', $ticket_id)->first();

        if ($ticket) {
            return response()->json([
                'success' => true,
                'replay' => $ticket->replay,
            ]);
        }

        // If the ticket is not found
        return response()->json([
            'success' => false,
            'message' => 'Ticket not found.',
        ]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'ticket_id' => 'required',
            'status_of_button' => 'required|in:1,2',
        ]);

        $ticket = BuildingAdminTicket::where('ticket_id', $request->ticket_id)->first();

        if (!$ticket) {
            $ticket = SchoolAdminTicket::where('ticket_id', $request->ticket_id)->first();
        }
        if (!$ticket) {
            $ticket = BuildingTenantTicket::where('ticket_id', $request->ticket_id)->first();
        }

        if (!$ticket) {
            $ticket = SuperAdminTicket::where('ticket_id', $request->ticket_id)->first();
        }

        if (!$ticket) {
            $ticket = BuildingSecurityTicket::where('ticket_id', $request->ticket_id)->first();
        }

        if (!$ticket) {
            $ticket = SchoolSecurityTicket::where('ticket_id', $request->ticket_id)->first();
        }

        if ($ticket) {
            $ticket->status_of_button = $request->status_of_button;
            $ticket->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Ticket not found']);
    }

    public function open_ticket()
    {
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'super_admin')->where('status_of_button', 0)->get();
        $ticket_data_1 = BuildingAdminTicket::

            with('followUps')
            ->get()
            ->sortByDesc('created_at');

        $get_all_ticket_new_from_school = SchoolAdminTicket::with('building', 'followUps')
            ->where('role', 'super_admin')
            ->where('status_of_button', 0)
            ->get();

        $ticket_data = $get_all_ticket_new_from_school->merge($ticket_data_1);

        return view('super-admin.ticket.openticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_new_from_school'));
    }

    public function hold_ticket()
    {
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'super_admin')->where('status_of_button', 1)->get();
        $ticket_data_1 = BuildingAdminTicket::with('followUps')->get()->sortByDesc('created_at');

        $get_all_ticket_new_from_school = SchoolAdminTicket::with('building', 'followUps')
            ->where('role', 'super_admin')
            ->where('status_of_button', 1)
            ->get();

        $ticket_data = $get_all_ticket_new_from_school->merge($ticket_data_1);

        return view('super-admin.ticket.holdticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_new_from_school'));
    }

    public function close_ticket()
    {
        $get_all_ticket_new = BuildingAdminTicket::with('building')->where('role', 'super_admin')->where('status_of_button', 2)->get();
        $ticket_data_1 = BuildingAdminTicket::with('followUps')->get()->sortByDesc('created_at');
        $get_all_ticket_new_from_school = SchoolAdminTicket::with('building', 'followUps')
            ->where('role', 'super_admin')
            ->where('status_of_button', 2)
            ->get();

        $ticket_data = $get_all_ticket_new_from_school->merge($ticket_data_1);

        return view('super-admin.ticket.closeticket', compact('get_all_ticket_new', 'ticket_data', 'get_all_ticket_new_from_school'));
    }

    public function store_MyTicket(Request $request)
    {

        // dd($request);
        $validatedData = $request->validate([
            'ticket_id' => 'required|string|max:255',
            'date_time' => 'required|date',
            'subject' => 'required|string|max:255',
            'role' => 'required|string|max:50',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
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

        $ticket = SuperAdminTicket::create([
            // 'building_id' => $building_id,
            'ticket_id' => $validatedData['ticket_id'],
            'date_time' => $validatedData['date_time'],
            'subject' => $validatedData['subject'],
            'role' => $validatedData['role'],
            'attachment' => $attachmentPath,
            'description' => $validatedData['description'],
            'added_by' => Auth::guard('superadmin')->user()->id,
            'created_at' => now(),
        ]);

        return redirect()->route('super-admin.my-ticket-index')->with('success', 'School Ticket created successfully.');

    }
}
