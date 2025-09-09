<?php

namespace App\Http\Controllers;

use App\Models\CurrentFeesMaster;
use App\Models\CenterManagements;
use Illuminate\Http\Request;
use App\Models\ClassMaster;

class CurrentFeesMasterController extends Controller
{
    // public function index()
    // {
    //     // $fees = CurrentFeesMaster::with('center')->get();
    //     // return view('current_fees_master.index', compact('fees'));
    //         $fees = CurrentFeesMaster::with(['center', 'class'])->get();
    //         return view('current_fees_master.index', compact('fees'));
    // }
// public function index()
// {
  
//     $fees = CurrentFeesMaster::with(['center', 'class'])->get();
//     return view('current_fees_master.index', compact('fees'));
// }

public function index(Request $request)
{
    $centers = CenterManagements::all();

    $feesQuery = CurrentFeesMaster::with(['center', 'class']);

    if ($request->filled('center_id')) {
        $feesQuery->where('center_id', $request->center_id);
    }

    if ($request->filled('class_id')) {
        $feesQuery->where('class_id', $request->class_id);
    }

    $fees = $feesQuery->get();

    return view('current_fees_master.index', compact('fees', 'centers'));
}


    public function create()
    {
        $centers = CenterManagements::all();
        $classes = ClassMaster::all();
        return view('current_fees_master.create', compact('centers','classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'center_id' => 'required|exists:center_managments,center_id',
            'class_id' => 'nullable|exists:class_masters,class_id',
            'fees_name' => 'required|string|max:255',
            'monthly_fees' => 'required|numeric|min:1',
            'ccfri' => 'required|numeric|min:1',
        ]);

        CurrentFeesMaster::create($request->only('center_id','class_id', 'fees_name', 'monthly_fees', 'ccfri'));

        return redirect()->route('current-fees-master.index')->with('success', 'Fee added successfully');
    }

    public function edit($id)
    {
        $fees = CurrentFeesMaster::findOrFail($id);
        $centers = CenterManagements::all();
        $classes = ClassMaster::all();
        return view('current_fees_master.edit', compact('fees', 'centers','classes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'center_id' => 'required|exists:center_managments,center_id',
            'class_id' => 'nullable|exists:class_masters,class_id',
            'fees_name' => 'required|string|max:255',
            'monthly_fees' => 'required|numeric|min:1',
            'ccfri' => 'required|numeric|min:1',
        ]);

        $fees = CurrentFeesMaster::findOrFail($id);
        $fees->update($request->only('center_id', 'class_id','fees_name', 'monthly_fees', 'ccfri'));

        return redirect()->route('current-fees-master.index')->with('success', 'Fee updated successfully');
    }

    public function destroy($id)
    {
        $fees = CurrentFeesMaster::findOrFail($id);
        $fees->delete();

        return redirect()->route('current-fees-master.index')->with('success', 'Fee deleted successfully');
    }
            public function getByCenter($centerId)
        {
            $classes = \App\Models\ClassMaster::where('center_id', $centerId)->get();
            return response()->json($classes);
        }
}

