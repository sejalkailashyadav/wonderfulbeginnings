<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeMaster;

class EmployeeMasterController extends Controller
{
    public function index()
    {
        $employees = EmployeeMaster::all();
        return view('employee_masters.index', compact('employees'));
    }

    public function create()
    {
        return view('employee_masters.create');
    }

//     public function store(Request $request)
//     {
//         // $data = $request->all();
        
//         $data = $r->validate([
//             'first_name' => 'required|max:100',
//             'last_name' => 'required|max:100',  'ece_license_expiry'=> 'required|max:100',
//             'primary_location' => 'required|max:100',
//             'first_aid_license' => 'required|max:100',
//             'first_aid_expiry' => 'required|max:100',
//             'police_clearance'=> 'required|max:100',
//             'police_clearance_expiry' => 'required|max:100',
//             'immunization_record' => 'required|max:100',
//             'covid_vaccine_record' => 'required|max:100',
//             'start_date' => 'required|max:100',
//             'probation_end_period' => 'required|max:100',
//             'three_reference_letter' => 'required|max:100',
//             'signed_handbook' => 'required|max:100',
//             'income_tax_forms'=> 'required|max:100',
//             'legal_work_doc' => 'required|max:100',
//   ]);
//         $employee = EmployeeMaster::create($data);
//         return redirect()->route('employee_masters.index')->with('success', 'Employee Added Successfully');
        
//     }



public function store(Request $request)
{
       $data = $request->validate([
        'first_name' => 'required|max:100',
        'last_name' => 'required|max:100',
        'mobile_number' => 'required|max:20',
        'email' => 'required|email|max:100',
        'primary_location' => 'required|max:100',
        'designation' => 'required|max:100',
        'ece_license_expiry' => 'required|date',
        'first_aid_expiry' => 'required|date',
        'police_clearance_expiry' => 'required|date',
        'start_date' => 'required|date',
        'probation_end_period' => 'required|date',
        'resume' => 'required|mimes:pdf|max:2048',
        'ece_license' => 'required|mimes:pdf|max:2048',
        'first_aid_license' => 'required|mimes:pdf|max:2048',
        'police_clearance' => 'required|mimes:pdf|max:2048',
        'immunization_record' => 'required|mimes:pdf|max:2048',
        'three_reference_letter' => 'required|mimes:pdf|max:2048',
        'signed_handbook' => 'required|mimes:pdf|max:2048',
        'covid_vaccine_record' => 'required|mimes:pdf|max:2048',
        'legal_work_doc' => 'required|mimes:pdf|max:2048',
        'income_tax_forms' => 'required|mimes:pdf|max:2048',
    ]);

    $uploadFields = [
        'resume',
        'ece_license',
        'first_aid_license',
        'police_clearance',
        'immunization_record',
        'three_reference_letter',
        'signed_handbook',
        'covid_vaccine_record',
        'legal_work_doc',
    ];

    foreach ($uploadFields as $field) {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data[$field] = '/public/uploads/' . $filename; 
        }
    }

    EmployeeMaster::create($data);
    $user = session('user'); 

if (!$user || !in_array($user['user_type'], ['Admin', 'Manager'])) 
{
    return redirect('https://cocomelonlearning.com/');
} else {
    return redirect()->route('employee_masters.index')
                     ->with('success', 'Employee Added Successfully');
}


    // return redirect()->route('employee_masters.index')->with('success', 'Employee Added Successfully');
}


public function show($id)
{
    $employee = EmployeeMaster::findOrFail($id);
    return view('employee_masters.show', compact('employee'));
}


    public function edit($id)
    {
        $employee = EmployeeMaster::findOrFail($id);
        return view('employee_masters.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = EmployeeMaster::findOrFail($id);
        // $data = $request->all();
         $data = $request->validate([
            'first_name' => 'nullable|max:100',
        'last_name' => 'nullable|max:100',
        'mobile_number' => 'nullable|max:20',
        'email' => 'nullable|email|max:100',
        'primary_location' => 'nullable|max:100',
        'designation' => 'nullable|max:100',
        'ece_license_expiry' => 'nullable|date',
        'first_aid_expiry' => 'nullable|date',
        'police_clearance_expiry' => 'nullable|date',
        'start_date' => 'nullable|date',
        'probation_end_period' => 'nullable|date',
        'resume' => 'nullable|mimes:pdf|max:2048',
        'ece_license' => 'nullable|mimes:pdf|max:2048',
        'first_aid_license' => 'nullable|mimes:pdf|max:2048',
        'police_clearance' => 'nullable|mimes:pdf|max:2048',
        'immunization_record' => 'nullable|mimes:pdf|max:2048',
        'three_reference_letter' => 'nullable|mimes:pdf|max:2048',
        'signed_handbook' => 'nullable|mimes:pdf|max:2048',
        'covid_vaccine_record' => 'nullable|mimes:pdf|max:2048',
         'income_tax_forms' => 'nullable|mimes:pdf|max:2048',
        'legal_work_doc' => 'nullable|mimes:pdf|max:2048',
   ]);
      
      $uploadFields = [
            'resume' => 'uploads/resumes',
            'ece_license' => 'uploads/ece_licenses',
            'first_aid_license' => 'uploads/first_aid_licenses',
            'police_clearance' => 'uploads/police_clearances',
            'immunization_record' => 'uploads/immunization_records',
            'three_reference_letter' => 'uploads/reference_letters',
            'signed_handbook' => 'uploads/handbooks',
            'covid_vaccine_record' => 'uploads/covid_vaccine',
            'legal_work_doc' => 'uploads/legal_docs',
        ];
        
        foreach ($uploadFields as $field => $path) {
            if ($request->hasFile($field)) {
                $data[$field] = $request->file($field)->store($path, 'public');
            }
        }
        
        $employee->update($data);
        return redirect()->route('employee_masters.index')->with('success', 'Employee Updated Successfully');
    }

    public function destroy($id)
    {
        EmployeeMaster::destroy($id);
        return redirect()->route('employee_masters.index')->with('success', 'Employee Deleted Successfully');
    }
}
?>