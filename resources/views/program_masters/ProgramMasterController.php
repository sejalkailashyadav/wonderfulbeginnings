<?php

namespace App\Http\Controllers;
use App\Models\CenterManagements;
use Illuminate\Support\Facades\DB;
use App\Models\ProgramMasters;
use App\Models\ProgramCreates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProgramMasterController extends Controller
{

    public function index(Request $request)
    {
        $centers = CenterManagements::all();
        $pros = ProgramCreates::all();

        // if ($request->has('center_id') && $request->center_id != '') {
        //     $pros = ProgramCreates::where('center_id', $request->center_id)->get();
        // } else {
        //     $pros = ProgramCreates::all();
        // }

        // Start the query with eager loading
        $query = ProgramMasters::with(['centers', 'programCreate']);

        // Filter by center_id
        if ($request->has('center_id') && $request->center_id != '') {
            $query->where('center_id', $request->center_id);
        }

        // Filter by prog_master_id
        if ($request->has('prog_master_id') && $request->prog_master_id != '') {
            $query->where('prog_master_id', $request->prog_master_id);
        }

        $programs = $query->get();

        return view('program_masters.index', compact('pros', 'centers', 'programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = CenterManagements::all();
        $programs = ProgramCreates::all();  // Get all centers
        $programCreates = ProgramCreates::all();  // fetch all program categories
        return view('program_masters.create', compact('centers', 'programs', 'programCreates'));

    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'center_id' => 'required|exists:center_managments,center_id',
            'prog_master_id' => 'required|exists:program_creates,prog_master_id',
            // 'program_name' => 'required',
            'number_of_days' => 'required|in:1,2,3,4,5,6,7',
            'program_fees' => 'required|numeric',
            'ccfri' => 'required|numeric',
            'accb' => 'nullable|numeric',
            'parent_fees' => 'required|numeric',
        ]);

        ProgramMasters::create($validated);
        return redirect('program-masters')->with('success', 'Program assigned successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $program = ProgramMasters::findOrFail($id);
        $centers = CenterManagements::all();
        $pros = ProgramCreates::all();
        return view('program_masters.edit', compact('program', 'centers', 'pros'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $program = ProgramMasters::findOrFail($id);
        $validated = $request->validate([
            'center_id' => 'required|exists:center_managments,center_id',
            'prog_master_id' => 'required|exists:program_creates,prog_master_id',
            'program_fees' => 'required',
            'ccfri' => 'required',
            'parent_fees' => 'required',
        ]);

        $program = ProgramMasters::findOrFail($id);
        $program->update($request->all());

        return redirect('program-masters')->with('success', 'Program updated successfully.');
    }

    public function getPrograms($center_id)
    {
        $programs = ProgramCreates::where('center_id', $center_id)->pluck('program_name', 'create_id');
        return response()->json($programs);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ProgramMasters::findOrFail($id)->delete();
        return redirect('program-masters')->with('success', 'Program deleted successfully.');
    }

// public function getProgramsByCenter($center_id)
// {
//     // $programs = ProgramCreates::where('center_id', $center_id)->get();
//     $programs = ProgramCreates::where('center_id', $center_id)
//     ->select('program_id', 'program_name', 'number_of_days', 'prog_master_id')
//     ->get();

//     return response()->json($programs);
// }
//    public function getProgramsByCenter($center_id)
//     {
//         // $programs = DB::table('program_masters')
//         //     ->join('program_creates', 'program_masters.prog_master_id', '=', 'program_creates.prog_master_id')
//         //     ->where('program_masters.center_id', $center_id)
//         //     ->select('program_masters.program_id', 'program_creates.program_name', 'program_masters.number_of_days')
//         //     ->get();
//         $programs = DB::table('program_masters')
//     ->join('program_creates', 'program_masters.prog_master_id', '=', 'program_creates.prog_master_id')
//     ->where('program_masters.center_id', $center_id)
//     ->select(
//         'program_masters.program_id', 
//         'program_masters.prog_master_id', 
//         'program_creates.program_name', 
//         'program_masters.number_of_days'
//     )
//     ->get();




//         return response()->json($programs);
//     }

public function getProgramsByCenter($center_id)
{
    $programs = DB::table('program_masters')
        ->join('program_creates', 'program_masters.prog_master_id', '=', 'program_creates.prog_master_id')
        ->where('program_masters.center_id', $center_id)
        ->select('program_masters.program_id', 'program_masters.prog_master_id', 'program_creates.program_name', 'program_masters.number_of_days')
        ->get();

    // Remove duplicate prog_master_id entries
    $uniquePrograms = $programs->unique('prog_master_id')->values();

    return response()->json($uniquePrograms);
}

}
