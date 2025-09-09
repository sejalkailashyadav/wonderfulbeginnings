<?php

namespace App\Http\Controllers;

use App\Models\ManagerMasters;
use App\Models\CenterManagements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagerMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = ManagerMasters::with('center')->get();
        return view('manager_masters.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = CenterManagements::all(); // Fetch all centers
        return view('manager_masters.create', compact('centers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'manager_name' => 'required|string|max:255',
            'manager_email' => 'required|email|unique:manager_masters,manager_email',
            'manager_num' => 'required|string|max:20',
            'center_id' => 'required|exists:center_managments,center_id',
        ]);

        ManagerMasters::create($validated);
        return redirect('manager-masters')->with('success', 'Manager created Successfully');
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
        $manager = ManagerMasters::findOrFail($id);
        $centers = CenterManagements::all();
        return view('manager_masters.edit', compact('manager', 'centers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'manager_name' => 'required|string',
            'manager_email' => 'required|email',
            'manager_num' => 'required|string',
            'center_id' => 'required|exists:center_managments,center_id',
        ]);

        $manager = ManagerMasters::findOrFail($id);
        $manager->update($request->all());

        return redirect('manager-masters')->with('success', 'Manager updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $manager = ManagerMasters::findOrFail($id);
        $manager->delete();

        return redirect('manager-masters')->with('success', 'Manager deleted successfully.');
    }
}
