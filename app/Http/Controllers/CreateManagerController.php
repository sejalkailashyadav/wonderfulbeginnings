<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserManagements;
use App\Models\CenterManagements;
class CreateManagerController extends Controller
{
    public function index()
    {
         $centers = CenterManagements::all();
           $lists = UserManagements::with('center')
    ->where('user_type', 'Manager')
    ->latest()
    ->paginate(10);

        // $lists = UserManagements::latest()->paginate(10);
        return view('create-manger.index', compact('lists','centers'));
    }
    public function create()
{

        $centers = CenterManagements::all();

    
    return view('create-manger.create', compact('centers'));
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
            'center_id' => 'nullable'
        ]);

        UserManagements::create($validated);
        return redirect()->route('create-manger.index')->with('success', 'Entry added to waiting list.');
    }

    public function edit(UserManagements $waiting_list)
    {

        $centers = CenterManagements::all();
    
     return view('create-manger.edit', compact('waiting_list','centers'));
    }

    public function update(Request $request, UserManagements $waiting_list)
    {
        $validated = $request->validate([
            'child_names' => 'required|string',
            'child_dobs' => 'required|string',
            'parent_names' => 'required|string',
            'parent_contact' => 'required|string',
            'requested_start_date' => 'required|date',
            'sibling_group' => 'nullable|boolean',
            'weekend_spot' => 'nullable|boolean',
            'care_type' => 'required|in:full-time,part-time',
               'preferred_location' => 'nullable',
            'notes' => 'nullable|string',
            'status' => 'required|in:requested,confirmed,cancelled',
        ]);

        $waiting_list->update($validated);
        return redirect()->route('create-manger.index')->with('success', 'Waiting list entry updated.');
    }

    public function destroy(UserManagements $waiting_list)
    {
        $waiting_list->delete();
        return redirect()->route('create-manger.index')->with('success', 'Entry removed from waiting list.');
    }
}