<?php

namespace App\Http\Controllers\Building;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuildingTicketController extends Controller
{
    public function dashboard()
    {
        return view('building-admin.ticket.ticket-dashboard');
    }

    public function new_ticket()
    {
        return view('building-admin.ticket.newticket');
    }

    public function open_ticket()
    {
        return view('building-admin.ticket.openticket');
    }

    public function hold_ticket()
    {
        return view('building-admin.ticket.holdticket');
    }

    public function close_ticket()
    {
        return view('building-admin.ticket.closeticket');
    }

    public function create_MyTicket()
    {
        return view('building-admin.ticket.myTicket-create');
    }

    public function index_MyTicket()
    {
        return view('building-admin.ticket.myTicket-index');
    }
}
