<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\CenterManagements;
use App\Models\ChildMasters;
use App\Models\ProgramMasters;
use App\Models\ProgramCreates;
use App\Models\FeesMasters;
use Illuminate\Http\Request;

class ChildMasterController extends Controller
{
    public function index()
    {
        $childs = ChildMasters::with(['center', 'program'])->latest()->get();
        return view('child_masters.index', compact('childs'));
    }

    public function toggleStatus(Request $request, $id)
    {
        $child = ChildMasters::findOrFail($id);
        $child->active_status = $request->status;
        $child->save();

        return response()->json(['success' => true]);
    }


    public function create()
    {
        $centers = CenterManagements::all();
        $programs = ProgramMasters::all();
        $programCreates = ProgramCreates::all();  // fetch all program categories

        return view('child_masters.create', compact('centers', 'programs', 'programCreates'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'center_id' => 'required|exists:center_managments,center_id',
            'program_id' => 'required|exists:program_masters,program_id',
            'child_first_name' => 'required|string|max:255',
            'child_last_name' => 'required|string|max:255',
            'parent_first_name' => 'required|string|max:255',
            'parent_last_name' => 'required|string|max:255',
            'institution_number' => 'required|string|max:50',
            'transit_number' => 'required|string|max:50',
            'account_number' => 'required',
            'active_status' => 'required|in:Active,Inactive',
            'number_of_days' => 'required|integer|min:1|max:7',
        ]);

        // Step 1: Create the child record
        $child = ChildMasters::create($validated);

        // Step 2: Fetch program details
        $program = DB::table('program_masters')
            ->where('program_id', $validated['program_id'])
            ->where('center_id', $validated['center_id'])
            ->first();

        if (!$program) {
            return back()->with('error', 'Program not found for this center.');
        }
        // Step 3: Insert fees_masters record
        FeesMasters::create([
            'center_id' => $validated['center_id'],
            'program_id ' => $validated['program_id'],
            'child_id' => $child->child_id,
            'child_dob' => $child->child_dob,
            'number_of_days' => $validated['number_of_days'],
            'parent_fees' => $program->parent_fees,
            'ccfri' => $program->ccfri,
            'accb_received' => $program->accb,
            'total_fees' => $program->program_fees,
            'institution_number' => $validated['institution_number'],
            'transit_number' => $validated['transit_number'],
            'account_number' => $validated['account_number'],
        ]);

        return redirect('child-masters')->with('success', 'Child and Fee record created successfully!');
    }

    public function show(string $id)
    {
        //
    }

    // public function edit(string $id)
    // {
    //     $child = ChildMasters::findOrFail($id);
    //     $centers = CenterManagements::all();

    //     // Get related program_masters with program_creates joined
    //     $programs = ProgramMasters::with('programCreate')
    //         ->where('center_id', $child->center_id)
    //         ->get();

    //     return view('child_masters.edit', compact('child', 'centers', 'programs'));
    // }

    // updat ecode for drodpwn change s
    public function edit(string $id)
    {
        $child = ChildMasters::findOrFail($id);
        $centers = CenterManagements::all();
        $programCreates = ProgramCreates::all();

        // Find the selected program
        $selectedProgram = ProgramMasters::where('program_id', $child->program_id)->first();

        return view('child_masters.edit', compact('child', 'centers', 'programCreates', 'selectedProgram'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $child = ChildMasters::findOrFail($id);
        $validated = $request->validate([
            'center_id' => 'required',
            'program_id' => 'required',
            'child_first_name' => 'required',
            'child_last_name' => 'required',
            'parent_first_name' => 'required',
            'parent_last_name' => 'required',
            'child_dob' => 'required|date',
            'parent_email' => 'required|email',
            'parent_mobile' => 'required',
            'institution_number' => 'required',
            'transit_number' => 'required',
            'admission_date' => 'required|date',
            'active_status' => 'required|in:Active,Inactive',
            'number_of_days' => 'required'
        ]);

        $child = ChildMasters::findOrFail($id);
        $child->update($request->all());

        return redirect('child-masters')->with('success', 'Fee record updated successfully.');
    }

    public function getPrograms($centerId)
    {
        $programs = ProgramMasters::where('center_id', $centerId)->pluck('program_name', 'Program_id');
        return response()->json($programs);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child = ChildMasters::findOrFail($id);
        $child->delete();
        return redirect('child-masters')->with('success', 'Child deleted successfully.');
    }

    // Get programs by center
    public function getProgramsByCenter($center_id)
    {
        $programs = DB::table('program_masters')
            ->join('program_creates', 'program_masters.prog_master_id', '=', 'program_creates.prog_master_id')
            ->where('program_masters.center_id', $center_id)
            ->select('program_masters.program_id', 'program_creates.program_name', 'program_masters.number_of_days')
            ->get();

        return response()->json($programs);
    }


    // Get valid number_of_days for selected center and program
    public function getDaysByCenterProgram(Request $request)
    {
        $days = ProgramMasters::where('center_id', $request->center_id)
            ->where('program_id', $request->program_id)
            ->pluck('number_of_days')
            ->unique()
            ->values();

        return response()->json($days);
    }



}