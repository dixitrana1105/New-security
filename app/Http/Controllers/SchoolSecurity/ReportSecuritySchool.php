<?php

namespace App\Http\Controllers\SchoolSecurity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\SchoolSecurityVisitor;

class ReportSecuritySchool extends Controller
{
    public function sub_tenant()
    {
        return view('school-security.report.sub-tenant');
    }

    public function visitor_log(Request $request)
    {
        $id = Auth::guard('schoolsecurity')->user()->id;

        $status = $request->input('status');

        $query = SchoolSecurityVisitor::where('added_by',$id);

        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('date', [$request->dateFrom, $request->dateTo]);
        }
    
        if ($status !== null) {
            $query->where('status', $status);
        }

        $visitor = $query->get();
        
        return view('school-security.report.visitor-log.index',compact('visitor'));
    }
}
