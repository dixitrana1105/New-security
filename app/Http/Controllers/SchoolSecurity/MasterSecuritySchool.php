<?php

namespace App\Http\Controllers\SchoolSecurity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\SchoolAdminSecurity;
use App\Models\SchoolStudents;

class MasterSecuritySchool extends Controller
{
    public function security_index(Request $request)
    {
        $status = $request->input('status');

        $id = Auth::guard('schoolsecurity')->user()->added_by;

        $query = SchoolAdminSecurity::where('added_by',$id);

        if ($status !== null) {
            $query->where('status', $status);  
        }

        $security = $query->get();

        return view('school-security.master.security-index',compact('security'));
    }

    public function student_index(Request $request)
    {
        $id = Auth::guard('schoolsecurity')->user()->id;
        $status = $request->input('status');

        $school_admin = SchoolAdminSecurity::select('added_by')->where('id', $id)->first();

        if ($school_admin) {
            $school_id = $school_admin->added_by;
    
            $query = SchoolStudents::where('school_id', $school_id);

            if ($status !== null) {
                $query->where('status', $status);  
            }

            $student = $query->get();
    
            return view('school-security.master.student-index', compact('student'));
        }    
        return redirect()->back()->with('error', 'No school found for this security.');
    
    }
}
