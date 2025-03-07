<?php

namespace App\Http\Controllers\SchoolAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SchoolStudents;

class StudentSchoolController extends Controller
{
    public function student_create()
    {
        return view('school-admin.student.create');
    }

    public function student_index()
    {
        $id = Auth::guard('buildingadmin')->user()->id;

        $student = SchoolStudents::where('school_id',$id)->get();
        return view('school-admin.student.index',compact('student'));
    }

    public function uploadCsv(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:csv,txt'
    ]);

    $id = Auth::guard('buildingadmin')->user()->id;

    $file = $request->file('file');
    $filePath = $file->getRealPath();

    $file = fopen($filePath, 'r');
    $isHeader = true;
    $data = [];

    while (($row = fgetcsv($file, 1000, ",")) !== FALSE) {
        if ($isHeader) {
            $isHeader = false;
            continue;
        }

        SchoolStudents::create([
            'student_id' => $row[0],
            'name' => $row[1],
            'middle' => $row[2],
            'last' => $row[3],
            'class' => $row[4],
            'section' => $row[5],
            'mobile' => $row[6],
            'whatsapp' => $row[7],
            'email' => $row[8],
            'guardian' => $row[9],
            'status' => $row[10],
            'school_id' => $id,
            // 'created_at' => now(),
            // 'updated_at' => now(),
        ]);

    }

    fclose($file);

    return redirect()->route('school.student.index')->with('success', 'CSV data uploaded successfully.');
}

public function student_edit($id)
{
    $value = SchoolStudents::where('id',$id)->first();
    return view('school-admin.student.edit',compact('value'));
}

public function student_update(Request $request, $id)
{
    $student = SchoolStudents::findOrFail($id);

    $student->update([
        'name' => $request->input('name'),
        'middle' => $request->input('middle'),
        'last' => $request->input('last'),
        'email' => $request->input('email'),
        'class' => $request->input('class'),
        'section' => $request->input('section'),
        'mobile' => $request->input('mobile'),
        'whatsapp' => $request->input('whatsapp'),
        'student_id' => $request->input('student_id'),
        'guardian' => $request->input('guardian'),
    ]);

    return redirect()->route('school.student.index')->with('success', 'Student details updated successfully.');

}

public function status(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $data = SchoolStudents::findOrFail($id);
        $data->status = $request->status;
        $data->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
    }

}
