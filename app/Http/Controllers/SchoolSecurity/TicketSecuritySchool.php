<?php

namespace App\Http\Controllers\SchoolSecurity;
use Illuminate\Support\Facades\Auth;

use App\Models\SchoolSecurityTicket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TicketSecuritySchool extends Controller
{
    public function dashboard()
    {
        $CountOfnewTicket = SchoolSecurityTicket::where('added_by', Auth::guard('schoolsecurity')
        ->user()->id)
->count();
        return view('school-security.ticket.dashboard', compact('CountOfnewTicket'));
    }

    public function closeticket_security()
    {
        return view('school-security.ticket.closeticket');
    }

    public function openticket_security()
    {
        return view('school-security.ticket.openticket');
    }

    public function newticket_security()
    {
        return view('school-security.ticket.newticket');
    }

    public function holdticket_security()
    {
        return view('school-security.ticket.holdticket');
    }

    public function myticket_school_index()
    {
        $ticket_data = SchoolSecurityTicket::where('added_by', Auth::guard('schoolsecurity')
        ->user()->id)
        ->with('followUps')
        ->get()
        ->sortByDesc('created_at');

        // dd($ticket_data);
        return view('school-security.ticket.my-ticket.index', compact('ticket_data'));
    }

    public function myticket_school_create()
    {

        $school_id = Auth::guard('schoolsecurity')->user()->id;

        // dd($school_id);



        $lastTicket = SchoolSecurityTicket::where('ticket_id', 'like', 'SCT' . $school_id . '%')
            ->orderBy('id', 'desc')
            ->first();

        if ($lastTicket) {
            $lastNumber = intval(substr($lastTicket->ticket_id, strlen('SCT' . $school_id)));
            $nextIndex = $lastNumber + 1;
        } else {
            $nextIndex = 1;
        }

        $ticketId = 'SCT' . $school_id . str_pad($nextIndex, 4, '0', STR_PAD_LEFT);
        return view('school-security.ticket.my-ticket.create', compact('ticketId'));
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

            $school_id = Auth::guard('schoolsecurity')->user()->id;

            // dd($building_id);


            // dd()

            $ticket = SchoolSecurityTicket::create([
                // 'building_id' => $building_id,
                'ticket_id'   => $validatedData['ticket_id'],
                'date_time'   => $validatedData['date_time'],
                'subject'     => $validatedData['subject'],
                'role'        => $validatedData['role'],
                'attachment'  => $attachmentPath,
                // 'building_id'  => $building_id,
                'description' => $validatedData['description'],
                'added_by' => $school_id,
                'created_at'  => now(),
            ]);

            return redirect()->route('school.security.my-ticket-index')->with('success', 'Ticket created successfully.');

    }
}
