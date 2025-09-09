<?php

namespace App\Http\Controllers;
use App\Models\CenterManagements;
use App\Models\ProgramCreates;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ProgramGenController extends Controller
{
    public function index()
    {
        //code
    }

    public function create()
    {
        $programs = ProgramCreates::all();  // Get all centers
        return view('program_create/create', compact('programs'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'program_name' => 'required|string|max:255',
        ]);

        // Create the new program
        ProgramCreates::create($validated);

        // Fetch all programs to display in the listing
        $programs = ProgramCreates::all();

        // Redirect to the program list page with success message and data
        return redirect()->route('program.create')->with('success', 'Program created successfully')->with('programs', $programs);
    }
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function update(Request $request, $id)
{
    $request->validate([
        'program_name' => 'required|string|max:255',
    ]);

    $program = ProgramCreates::findOrFail($id);
    $program->program_name = $request->program_name;
    $program->save();

    return response()->json(['message' => 'Program name updated successfully.']);
}


    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $program = ProgramCreates::findOrFail($id);
        $program->delete();

        return redirect()->back()->with('success', 'Program deleted successfully.');
    }


}