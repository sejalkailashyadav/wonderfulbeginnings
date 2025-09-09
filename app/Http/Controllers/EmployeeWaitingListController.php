<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployeeWaitlist;

class EmployeeWaitingListController extends Controller
{
    public function index()
    {
        $employees = EmployeeWaitlist::all();
        return view('employee_waitlist.index', compact('employees'));
    }

    public function create()
    {
        return view('employee_waitlist.create');
    }


public function store(Request $request)
{
    $data = $request->validate([
        'first_name' => 'required|max:100',
        'last_name' => 'required|max:100',
         'designation' => 'required',
        'mobile_number' => 'required|max:20',
        'email' => 'required|email',
        'reference' => 'required|max:255',
        'expected_start_date' => 'required|date',
        'resume' => 'nullable|mimes:pdf|max:2048',
        
    ]);
    //resume doc 
     if ($request->hasFile('resume')) {
        $file = $request->file('resume');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);
        $data['resume'] = '/public/uploads/' . $filename;
    }

    EmployeeWaitlist::create($data);

    return redirect()->route('employee_waitlist.index')->with('success', 'Employee Added Successfully');
}


public function show($id)
{
    $employee = EmployeeWaitlist::findOrFail($id);
    return view('employee_waitlist.show', compact('employee'));
}


    public function edit($id)
    {
        $employee = EmployeeWaitlist::findOrFail($id);
        return view('employee_waitlist.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = EmployeeWaitlist::findOrFail($id);
         
          $data = $request->validate([
        'first_name' => 'required|max:100',
        'last_name' => 'required|max:100',
         'designation' => 'required',
        'mobile_number' => 'required|max:20',
        'email' => 'required|email',
        'reference' => 'required|max:255',
        'expected_start_date' => 'required|date',
        'resume' => 'nullable|mimes:pdf|max:2048',
        
    ]);
      
      //resume doc 
       if ($request->hasFile('resume')) {
            $file = $request->file('resume');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['resume'] = '/public/uploads/' . $filename;
        }

        $employee->update($data);
        return redirect()->route('employee_waitlist.index')->with('success', 'Employee Updated Successfully');
    }

    public function destroy($id)
    {
        EmployeeWaitlist::destroy($id);
        return redirect()->route('employee_waitlist.index')->with('success', 'Employee Deleted Successfully');
    }
}
?>