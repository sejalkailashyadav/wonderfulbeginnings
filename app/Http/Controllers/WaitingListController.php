<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WaitingList;
use App\Models\CenterManagements;
class WaitingListController extends Controller
{
    public function index()
    {
        $lists = WaitingList::latest()->paginate(100);
        return view('waiting-lists.index', compact('lists'));
    }

    // public function create()
    // {
    //      $centers = CenterManagements::all();
    //          return view('waiting-lists.create', compact('centers'));
    // }
    
    public function create()
{
    $user = session('user');

    // if ($user->user_type === 'Manager') {
    //     $centers = CenterManagements::where('center_id', $user->center_id)->get();
      
    // } else {
        $centers = CenterManagements::all();
    // }  
    
    return view('waiting-lists.create', compact('centers'));
}

    public function store(Request $request)
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

        WaitingList::create($validated);
           $user = session('user'); 
        if (!$user || !in_array($user['user_type'], ['Admin', 'Manager'])) 
        {
            return redirect('https://cocomelonlearning.com/');
        } else {
            return redirect()->route('waiting-lists.index')
                             ->with('success', 'Employee Added Successfully');
        }


        // return redirect()->route('.index')->with('success', 'Entry added to waiting list.');
    }
    
  
  //ewn import form wordressps 
  public function importFromWordpress()
{
    // Create a temporary DB connection to WordPress
    $wordpressDB = \DB::connection('mysql')->setPdo(
        new \PDO(
            "mysql:host=103.195.185.115;dbname=cocomelo_database;charset=utf8mb4",
            "cocomelo_user",     
            "#jO09786#", 
            [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
            ]
        )
    );

    // Now query the WordPress table
    $forms = $wordpressDB->table('wp_db7_forms')
                         ->where('form_post_id', 4669)
                         ->get();

    $count = 0;

    foreach ($forms as $form) {
        $data = unserialize($form->form_value);

        $mapped = [
            'child_names'        => $data['your-name'] ?? null,
            'child_dobs'         => $data['DOB-of-Child'] ?? null,
            'parent_names'       => $data['email'] ?? null,
            'parent_contact'     => $data['your-contact'] ?? null,
            'requested_start_date' => $data['Requested-Start-Date'] ?? null,
            'sibling_group'      => 0,
            'weekend_spot'       => 0,
            'care_type'          => isset($data['select'][0]) ? strtolower(str_replace(' ', '-', $data['select'][0])) : null,
            'preferred_location' => null,
            'notes'              => $data['message'] ?? null,
            'status'             => 'requested',
        ];

        // Prevent duplicates
        $exists = \App\Models\WaitingList::where('parent_contact', $mapped['parent_contact'])
                                         ->where('requested_start_date', $mapped['requested_start_date'])
                                         ->first();

        if (!$exists) {
            \App\Models\WaitingList::create($mapped);
            $count++;
        }
    }

    return " Imported {$count} new entries from WordPress!";
}



    public function edit(WaitingList $waiting_list)
    {
        //   $centers = CenterManagements::all();
        // return view('waiting-lists.edit', compact('waiting_list','centers'));
        $user = session('user');

    if ($user->user_type === 'Manager') {
        $centers = CenterManagements::where('center_id', $user->center_id)->get();
      
    } else {
        $centers = CenterManagements::all();
    }  
     return view('waiting-lists.edit', compact('waiting_list','centers'));
    }

    public function update(Request $request, WaitingList $waiting_list)
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
        return redirect()->route('waiting-lists.index')->with('success', 'Waiting list entry updated.');
    }

    public function destroy(WaitingList $waiting_list)
    {
        $waiting_list->delete();
        return redirect()->route('waiting-lists.index')->with('success', 'Entry removed from waiting list.');
    }
}