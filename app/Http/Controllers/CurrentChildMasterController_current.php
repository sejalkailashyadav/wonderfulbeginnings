<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\CenterManagements;
use App\Models\CurrentChildMaster;
use App\Models\ChildMasters;
use App\Models\ClassMaster;
use App\Models\ProgramMasters;
use App\Models\CurrentFeesMaster;
use App\Models\ProgramCreates;
use App\Models\FeesMasters;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CurrentChildMasterController extends Controller
{

    // public function index()
    // {
    //     // it check if  status is withdrawal then after 24 hours it will automatically set to Achove 
    //     \App\Models\CurrentChildMaster::where('status', 2)
    //         ->whereDate('withdrawal_date', '<', now()->toDateString())
    //         ->update(['status' => 3]);

    //     $childs = CurrentChildMaster::with(['center', 'class', 'fee'])->get(); // Or use pagination if needed

    //     $centers = \App\Models\CenterManagements::all();
    //     $fees = \App\Models\CurrentFeesMaster::all();

    //     return view('current_child_masters.index', compact('childs', 'centers', 'fees'));
    // }
//admin & manger nmidkeare afte test  //now commemst 

// public function index(Request $request)
// {
//     $user = session('user');

//     // if Admin: show all
//     if ($user->user_type === 'Admin') {
//         $childs = CurrentChildMaster::with(['center', 'class', 'fee'])->get();
//     } else {
//         // if Manager: only show their center's children
//         $childs = CurrentChildMaster::with(['center', 'class', 'fee'])
//             ->where('center_id', $user->center_id)
//             ->get();
//     }

//     $centers = CenterManagements::all();
//     $fees = CurrentFeesMaster::all();

//     return view('current_child_masters.index', compact('childs', 'centers', 'fees'));
// }

//wed chnage now 


public function index(Request $request)
{
    $user = session('user');

    $query = CurrentChildMaster::with(['center', 'class', 'fee']);

    if ($user->user_type !== 'Admin') {
        $query->where('center_id', $user->center_id);
    }

    if ($request->filled('class_id')) {
        $query->where('class_id', $request->input('class_id'));
    }

    if ($request->filled('status')) {
        $query->where('status', $request->input('status'));
    }

    $childs = $query->get();

    $centers = CenterManagements::all();
    $fees = CurrentFeesMaster::all();

    // nly fetch classes that are in the current result set (filtered)
    if ($user->user_type === 'Admin') {
        $classes = ClassMaster::all();
    } else {
        // anager: only classes where their center has children
        $classIds = $childs->pluck('class_id')->unique()->filter();
        $classes = ClassMaster::whereIn('class_id', $classIds)->get();
    }

    return view('current_child_masters.index', compact('childs', 'centers', 'fees', 'classes'));
}



    //update names's filter with search bar  now 
    public function filter(Request $request)
    {
        $query = CurrentChildMaster::with(['center', 'class', 'fee']);

        if ($request->center_id) {
            $query->where('center_id', $request->center_id);
        }

        if ($request->fee_id) {
            $query->where('fees_id', $request->fee_id);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('child_first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('child_last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('parent_first_name', 'like', '%' . $request->search . '%')
                    ->orWhere('parent_last_name', 'like', '%' . $request->search . '%');
            });
        }

        $childs = $query->get();

        $view = view('current_child_masters.partials.child-table', compact('childs'))->render();

        return response()->json([
            'success' => true,
            'html' => $view,
        ]);
    }

//admin & manger access 


// public function filter(Request $request)
// {
//     $user = session('user');

//     $query = CurrentChildMaster::with(['center', 'fees', 'class']);

//     if ($user->user_type !== 'Admin') {
//         $query->where('center_id', $user->center_id);
//     } else {
//         if ($request->center_id) {
//             $query->where('center_id', $request->center_id);
//         }
//     }

//     if ($request->fee_id) {
//         $query->where('fee_id', $request->fee_id);
//     }

//     if ($request->search) {
//         $query->where(function ($q) use ($request) {
//             $q->where('child_name', 'like', '%' . $request->search . '%')
//               ->orWhere('parent_name', 'like', '%' . $request->search . '%');
//         });
//     }

//     $childs = $query->get();

//     $html = view('current_child_masters.partials.child-table', compact('childs'))->render();

//     return response()->json([
//         'success' => true,
//         'html' => $html
//     ]);
// }



    public function toggleStatus(Request $request, $id)
    {
        $child = ChildMasters::findOrFail($id);
        $child->active_status = $request->status;
        $child->save();

        return response()->json(['success' => true]);
    }

    // public function create()
    // {
    //     $centers = CenterManagements::all();
    //     $classes = ClassMaster::all();
    //     $fees = CurrentFeesMaster::all();
    //     $allChildren = CurrentChildMaster::all();
    //     return view('current_child_masters.create', compact('centers', 'classes', 'fees', 'allChildren'));
    // }

//amager & admin 

public function create()
{
    $user = session('user');

    if ($user->user_type === 'Manager') {
        $centers = CenterManagements::where('center_id', $user->center_id)->get();
        $classes = ClassMaster::where('center_id', $user->center_id)->get();
        $fees = CurrentFeesMaster::where('center_id', $user->center_id)->get();
        $allChildren = CurrentChildMaster::where('center_id', $user->center_id)->get();
    } else {
        $centers = CenterManagements::all();
        $classes = ClassMaster::all();
        $fees = CurrentFeesMaster::all();
        $allChildren = CurrentChildMaster::all();
    }
    // $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
 $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    return view('current_child_masters.create', compact('centers', 'classes', 'fees', 'allChildren','daysOfWeek'));
}

    public function store(Request $r)
    {

        $data = $r->validate([
            'child_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'center_id' => 'required|exists:center_managments,center_id',
            'fees_id' => 'required|exists:current_fees_masters,id',
            'class_id' => 'nullable|exists:class_masters,class_id',
            'child_first_name' => 'required|max:100',
            'child_last_name' => 'required|max:100',
            'parent_first_name' => 'required|max:100',
            'parent_last_name' => 'required|max:100',
            // 'child_dob' => 'required|date',
            'child_dob' => 'required|date|before_or_equal:' . Carbon::now()->toDateString(),
            'parent_email' => 'required|email|max:150',
            'parent_mobile' => 'required|digits_between:7,20',
            'institution_number' => 'required|max:200',
             'other_institution' => 'nullable|string|max:200',
            'transit_number' => 'required|digits_between:3,20',
            'account_number' => 'required|max:50',
            'emergency_contact_name' => 'required|max:100',
            'emergency_contact_number' => 'required',
            'emergency_contact_relations' => 'required|max:100',
            'emergency_contact_name2' => 'required|max:100',
            'emergency_contact_number2' => 'required',
            'emergency_contact_relation2' => 'required|max:100',
             'emergency_contact_name2' => 'required|max:100',
            'emergency_contact_number2' => 'required',
            'emergency_contact_relation2' => 'required|max:100',
             'emergency_contact_name3'=> 'required|max:100',
            'emergency_contact_number3'=> 'required|max:100',
            'emergency_contact_relation3'=> 'required|max:100',
            'admission_date' => 'required|date',
            'end_date' => 'nullable|date',
            'special_notes' => 'nullable|max:500',
            'registration_fees_paid' => 'nullable|numeric',
            'issibling' => 'required|boolean',
            'no_of_days' => 'array',
            'sibling_child_id' => 'nullable|exists:current_child_masters,child_id',
            'custody_agreement' => 'nullable|file|mimes:pdf',
            'registration_docs.*' => 'nullable|file|mimes:pdf',
            'status' => 'nullable|in:0,1,2,3',
            'withdrawal_requeste_date' => 'nullable|date',
            'withdrawal_date' => 'nullable|date',
            'withdrawal_note' => 'nullable|string',
            'health_card' => 'nullable|max:500',
        ]);

        if ($r->input('has_custody_agreement') == 1) {
            $rules['custody_agreement'] = 'required|file|mimes:pdf';
        }


        // CUSTODY AGREEMENT (single file)
        if ($r->hasFile('custody_agreement')) {
            $file = $r->file('custody_agreement');
            $filename = time() . '_custody_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['custody_agreement'] = '/public/uploads/' . $filename;

        }

        // REGISTRATION DOCS (multiple files)
        if ($r->hasFile('registration_docs')) {
            $docs = [];
            foreach ($r->file('registration_docs') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $docs[] = '/public/uploads/' . $filename;
            }
            $data['other_file_doc'] = json_encode($docs);
        }


        // CHILD PICTURE
        if ($r->hasFile('child_picture')) {
            $file = $r->file('child_picture');
            $filename = time() . '_child_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['child_picture'] = '/public/uploads/' . $filename;
        }

        if ($r->input('issibling') == 1 && $r->filled('sibling_child_id')) {
            $data['sibling_child_id'] = $r->input('sibling_child_id');
        } else {
            $data['sibling_child_id'] = null;
        }


if ($data['institution_number'] === 'Other') {
    if (empty($data['other_institution'])) {
        return back()->withErrors(['other_institution' => 'Please specify the institution name.'])->withInput();
    }
    $data['institution_number'] = $data['other_institution'];
} else {
    $data['institution_number'] = $data['institution_number'];
}



            //no of days 
            
//  $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
 $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $selectedDays = $r->input('no_of_days', []);

    $data['no_of_days'] = json_encode(
        collect($daysOfWeek)->mapWithKeys(fn($day) => [$day => in_array($day, $selectedDays) ? 1 : 0])
    );  
        if ($data['status'] == 2) {
            // If Withdrawal, capture additional fields
            $data['withdrawal_date'] = $r->withdrawal_date;
             $data['withdrawal_requeste_date'] = $r->withdrawal_requeste_date;
            $data['withdrawal_note'] = $r->withdrawal_note;
        } else {
            // Reset withdrawal fields if not selected
            $data['withdrawal_date'] = null;
             $data['withdrawal_requeste_date'] = null;
            $data['withdrawal_note'] = null;
        }
        CurrentChildMaster::create($data);

        return redirect()->route('current-child-masters.index')
            ->with('success', 'Child and fee record created successfully!');
    }

    public function show(string $id)
    {
        $child = CurrentChildMaster::with(['center', 'class', 'fee'])->findOrFail($id);
        return view('current_child_masters.show', compact('child'));
    }

//amberg & Admin 


// public function show(string $id)
// {
//     $user = session('user');
//     // dd(session('user'), $id);

//     $child = CurrentChildMaster::with(['center', 'class', 'fee'])->findOrFail($id);

//     // If user is not Admin, restrict access by center
//     if ($user->user_type !== 'Admin' && $child->center_id != $user->center_id) {
//     abort(403, 'Unauthorized');
// }


//     return view('current_child_masters.show', compact('child'));
// }

    //updaate 16 today now
    // public function edit($id)
    // {
    //     $child = CurrentChildMaster::findOrFail($id);
    //     $centers = CenterManagements::all();
    //     $classes = ClassMaster::all();
    //     $fees = CurrentFeesMaster::all();
    //     $allChildren = CurrentChildMaster::where('child_id', '!=', $id)->get(); // exclude self
    
    //     return view('current_child_masters.edit', compact('child', 'centers', 'classes', 'fees', 'allChildren',));
    // }

//magnger & admin 


public function edit($id)
{
    $user = session('user');
    $child = CurrentChildMaster::findOrFail($id);

    // Restrict access if user is Manager and doesn't belong to this center
    if ($user->user_type === 'Manager' && $child->center_id != $user->center_id) {
        return redirect()->back()->with('error', 'Access denied.');
    }

    if ($user->user_type === 'Manager') {
        $centers = CenterManagements::where('center_id', $user->center_id)->get();
        $classes = ClassMaster::where('center_id', $user->center_id)->get();
        $fees = CurrentFeesMaster::where('center_id', $user->center_id)->get();
        $allChildren = CurrentChildMaster::where('center_id', $user->center_id)
                            ->where('child_id', '!=', $id)->get();
    } else {
        $centers = CenterManagements::all();
        $classes = ClassMaster::all();
        $fees = CurrentFeesMaster::all();
        $allChildren = CurrentChildMaster::where('child_id', '!=', $id)->get();
    }

//  $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
 $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $selectedDays = collect(json_decode($child->no_of_days, true))
        ->filter(fn($v) => $v == 1)
        ->keys()
        ->toArray();
    return view('current_child_masters.edit', compact('child', 'centers', 'classes', 'fees', 'allChildren','daysOfWeek', 'selectedDays'));
}

    public function update(Request $r, $id)
    {
        $rules = [
            'center_id' => 'required|exists:center_managments,center_id',
            'class_id' => 'nullable|exists:class_masters,class_id',
            'fees_id' => 'required|exists:current_fees_masters,id',
            'child_first_name' => 'required|max:100',
            'child_last_name' => 'required|max:100',
            'parent_first_name' => 'required|max:100',
            'parent_last_name' => 'required|max:100',
            'child_dob' => 'required|date',
            'parent_email' => 'nullable|email|max:150',
            'parent_mobile' => 'nullable|digits_between:7,20',
            'institution_number' => 'max:200',
             'other_institution' => 'nullable|string|max:200',
            'transit_number' => 'nullable',
            'account_number' => 'max:50',
            'emergency_contact_name' => 'required|max:100',
            'emergency_contact_number' => 'required|digits_between:7,20',
            'emergency_contact_relations' => 'required',
            'emergency_contact_name2' => 'required|max:100',
            'emergency_contact_number2' => 'required|digits_between:7,20',
            'emergency_contact_relation2' => 'required|max:100',
            'emergency_contact_name3'=> 'required|max:100',
            'emergency_contact_number3'=> 'required|max:100',
            'emergency_contact_relation3'=> 'required|max:100',
            'admission_date' => 'required',
            'no_of_days' => 'array',
            'end_date' => 'nullable|date',
            'special_notes' => 'nullable|max:500',
            'registration_fees_paid' => 'nullable|numeric',
            /*  'issibling' => 'required|boolean','sibling_child_id' => 'nullable|exists:current_child_masters,child_id',
             files */
            'issibling' => 'required|boolean',
            'sibling_child_id' => 'nullable|exists:current_child_masters,child_id',
            //       'has_custody_agreement'  => 'required|boolean',
            // 'custody_agreement'      => 'nullable|file|mimes:pdf',
            'status' => 'nullable|in:0,1,2,3',
            'withdrawal_date' => 'nullable|date',
            'withdrawal_requeste_date' => 'nullable|date',
            'withdrawal_note' => 'nullable|string',
            'health_card_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'registration_docs.*' => 'nullable|file|mimes:pdf|max:2048',
        ];

        if ($r->input('has_custody_agreement') == 1) {
            $rules['custody_agreement'] = 'required|file|mimes:pdf';
        }

        $data = $r->validate($rules);

        $child = CurrentChildMaster::findOrFail($id);

        // 1. Multiple Registration PDFs
        if ($r->hasFile('registration_docs')) {
            // merge with any existing docs
            $existing = $child->other_file_doc ? json_decode($child->other_file_doc, true) : [];
            $uploaded = [];

            foreach ($r->file('registration_docs') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $uploaded[] = '/public/uploads/' . $filename;
            }

            $data['other_file_doc'] = json_encode(array_merge($existing, $uploaded));
        }
        //no of day
        
        //insitiden 
        
        if ($r->input('institution_number') === 'Other') {
    if (empty($r->input('other_institution'))) {
        return back()->withErrors(['other_institution' => 'Please specify the institution name.'])->withInput();
    }
    $finalInstitution = $r->input('other_institution');
} else {
    $finalInstitution = $r->input('institution_number');
}

// Assign to data array before updating
$data['institution_number'] = $finalInstitution;


//  $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
 $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    $selectedDays = $r->input('no_of_days', []);

    $data['no_of_days'] = json_encode(
        collect($daysOfWeek)->mapWithKeys(fn($day) => [$day => in_array($day, $selectedDays) ? 1 : 0])
    );

        // 2. Custody Agreement – replace old if new uploaded
        if ($r->hasFile('custody_agreement')) {
            // remove old file (from public folder manually)
            if ($child->custody_agreement && file_exists(public_path($child->custody_agreement))) {
                unlink(public_path($child->custody_agreement));
            }

            $file = $r->file('custody_agreement');
            $filename = time() . '_custody_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['custody_agreement'] = '/public/uploads/' . $filename;
        }


        // 3. Health Card – allow text or file
        if ($r->hasFile('health_card_file')) {
            if ($child->health_card && Storage::disk('public')->exists($child->health_card)) {
                Storage::disk('public')->delete($child->health_card);
            }
            $data['health_card'] =
                $r->file('health_card_file')->store('health_cards', 'public');
        } elseif ($r->filled('health_card_text')) {
            $data['health_card'] = $r->input('health_card_text');
        }

        // Remove keys that are files but not DB columns
        unset($data['health_card_file'], $data['health_card_text']);

        // Sibling logic
        $data['sibling_child_id'] = ($r->input('issibling') == 1 && $r->filled('sibling_child_id'))
            ? $r->input('sibling_child_id')
            : null;

       if (!empty($data['status']) && $data['status'] == 2) {
            $data['withdrawal_date'] = $r->withdrawal_date;
            $data['withdrawal_requeste_date'] = $r->withdrawal_requeste_date;
            $data['withdrawal_note'] = $r->withdrawal_note;
            
        } else {
            $data['withdrawal_date'] = null;
            $data['withdrawal_requeste_date'] = null;
            $data['withdrawal_note'] = null;
        }

        
        
// Profile picture upload
if ($r->hasFile('child_picture')) {
    // Remove old picture if exists
    if ($child->child_picture && file_exists(public_path($child->child_picture))) {
        unlink(public_path($child->child_picture));
    }

    $file = $r->file('child_picture');
    $filename = time() . '_profile_' . $file->getClientOriginalName();
    $file->move(public_path('uploads'), $filename);

    $data['child_picture'] = '/public/uploads/' . $filename;


}
        $child = CurrentChildMaster::findOrFail($id);



  if ($r->input('action') === 'approve') {
        $data['status'] = 1; // Active
    } elseif ($r->input('action') === 'withdraw') {
        $data['status'] = 2; // Withdrawal
        $data['withdrawal_date'] = $r->input('withdrawal_date');
        $data['withdrawal_requeste_date'] =  $r->input('withdrawal_requeste_date');
        $data['withdrawal_note'] = $r->input('withdrawal_note');
    }

    // Reset withdrawal fields if not withdrawing
    if (!isset($data['status']) || $data['status'] != 2) {
        $data['withdrawal_date'] = null;
         $data['withdrawal_date'] = null;
        $data['withdrawal_requeste_date'] = null;
    }


        /* -------- PERSIST -------- */
        $child->update($data);



        return redirect()
            ->route('current-child-masters.index')
            ->with('success', 'Child updated successfully!');

    }

    public function destroy($id)
    {
        $child = CurrentChildMaster::findOrFail($id);
        $child->delete();

        return redirect()
            ->route('current-child-masters.index')
            ->with('success', 'Child deleted successfully.');
    }

//amdin & manerg 



// public function destroy($id)
// {
//     $user = session('user');
//     $child = CurrentChildMaster::findOrFail($id);

//     if ($user->user_type === 'Manager' && $child->center_id != $user->center_id) {
//         return redirect()->back()->with('error', 'Unauthorized delete access.');
//     }

//     $child->delete();
//     return redirect()->back()->with('success', 'Child deleted successfully.');
// }

public function approve($id)
{
    $child = CurrentChildMaster::findOrFail($id);
    if ($child->status == 0) {
        $child->status = 1; // Approved
 
        $child->save();
    }
    return redirect()->back()->with('success', 'Child approved successfully.');
}

    public function getPrograms($centerId)
    {
        $programs = ProgramMasters::where('center_id', $centerId)->pluck('program_name', 'Program_id');
        return response()->json($programs);
    }

    public function getProgramsByCenter($center_id)
    {
        $programs = DB::table('program_masters')
            ->join('program_creates', 'program_masters.prog_master_id', '=', 'program_creates.prog_master_id')
            ->where('program_masters.center_id', $center_id)
            ->select('program_masters.program_id', 'program_creates.program_name', 'program_masters.number_of_days')
            ->get();

        return response()->json($programs);
    }

    public function getDaysByCenterProgram(Request $request)
    {
        $days = ProgramMasters::where('center_id', $request->center_id)
            ->where('program_id', $request->program_id)
            ->pluck('number_of_days')
            ->unique()
            ->values();

        return response()->json($days);
    }
    
    public function showChildren($class_id)
{
    $class = ClassMaster::with(['children'])->findOrFail($class_id);

    return view('class_masters.class_children', compact('class'));
}


    public function getFeesByCenters(Request $request)
{
    $centerId = $request->center_id;

    
    $fees = CurrentFeesMaster::where('center_id', $centerId)->get();

    return response()->json(['fees' => $fees]);
}
//     public function getFeesByCenter($center_id)
// {
//     $fees = \App\Models\CurrentFeesMaster::where('center_id', $center_id)->get();
//     return response()->json($fees);
// }



public function getClassesByCenter($centerId)
{
    $classes = ClassMaster::where('center_id', $centerId)->get();
    return response()->json($classes);
}

public function getFeesByCenterAndClass($centerId, $classId)
{
    $fees = CurrentFeesMaster::where('center_id', $centerId)
        ->where('class_id', $classId)
        ->get();
    return response()->json($fees);
}


}