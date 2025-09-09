<?php

namespace App\Http\Controllers;

use App\Models\CenterManagements;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassMasterController extends Controller
{
    // public function index()
    // {
    //     $class = ClassMaster::all(); // fetch all records
    //     return view('class_masters.index', compact('class'));
    // }
    
    
    //maner& admin
    
    
//      public function index()
//  {
// $user = session('user');

// if ($user['user_type'] === 'Admin') {
//     // Admin sees all centers
//     $class = ClassMaster::withCount(['classes'])->get();
// } else {
//     // Manager sees only their center
//     $class = ClassMaster::withCount(['classes'])
//         ->where('center_id', $user['center_id'])
//         ->get();
// }
//   return view('class_masters.index', compact('class', 'user'));
// }

//updat elisyting of tusndet count sttau s& widthdon 

// public function index()
// {
//     $user = session('user');

//     // Always update the enrolled counts before showing the page
//     DB::statement("
//         UPDATE class_masters cm
//         JOIN (
//             SELECT 
//                 class_id,
//                 CONCAT(
//                     'Active: ', 
//                     SUM(CASE WHEN status != 2 THEN 1 ELSE 0 END),
//                     ' | Withdrawn: ',
//                     SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END)
//                 ) AS enrolled_status
//             FROM current_child_masters
//             GROUP BY class_id
//         ) AS counts ON cm.class_id = counts.class_id
//         SET cm.total_currently_enrolled = counts.enrolled_status
//     ");

//     // Fetch classes based on user role
//     if ($user['user_type'] === 'Admin') {
//         $class = ClassMaster::with('center')->get();
//     } else {
//         $class = ClassMaster::with('center')
//             ->where('center_id', $user['center_id'])
//             ->get();
//     }

//     return view('class_masters.index', compact('class', 'user'));
// }

//chaged 18-08-2025


public function index(Request $request)
{
    $user = session('user');

    // Always update enrolled counts
    DB::statement("
        UPDATE class_masters cm
        JOIN (
            SELECT 
                class_id,
                CONCAT(
                    'Active: ', 
                    SUM(CASE WHEN status != 2 THEN 1 ELSE 0 END),
                    ' | Withdrawn: ',
                    SUM(CASE WHEN status = 2 THEN 1 ELSE 0 END)
                ) AS enrolled_status
            FROM current_child_masters
            GROUP BY class_id
        ) AS counts ON cm.class_id = counts.class_id
        SET cm.total_currently_enrolled = counts.enrolled_status
    ");

    $query = ClassMaster::with('center');

    if ($user['user_type'] !== 'Admin') {
        // Non-admin can only see their own center
        $query->where('center_id', $user['center_id']);
    }

    if ($request->filled('center_id')) {
        // Apply filter from dropdown
        $query->where('center_id', $request->center_id);
    }

    $class = $query->get();
    $centers = CenterManagements::all();

    return view('class_masters.index', compact('class', 'user', 'centers'));
}





//     public function store(Request $request)
// {
//     $data = $request->all();

//     if ($request->hasFile('classroom_schedules')) {
//         $file = $request->file('classroom_schedules');
//         $filename = time() . '_schedule_' . $file->getClientOriginalName();
//         $file->move(public_path('uploads'), $filename);
//         $data['classroom_schedules'] = 'uploads/' . $filename;
//     }

//     ClassMaster::create($data);

//     return redirect()->back()->with('success', 'Class created successfully');
// }

    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'center_name' => 'required|string|max:255',
    //         'center_address' => 'required|string|max:255',
    //         'center_email' => 'required|email|max:255',
    //     ]);

    //     $center = ClassMaster::findOrFail($id);
    //     $center->update($request->all());

    //     return redirect('center-managements')->with('success', 'Center updated successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     */
     
      public function show(string $id)
    {
        //
    }
    
     public function edit(string $id)
{
    $class = ClassMaster::findOrFail($id);
    return view('class_masters.edit', compact('class'));
}


    // public function update(Request $request, string $id)
// {
//      $request->validate([
//             'class_name' => 'required',
//             'amount_of_children' => 'required'
//         ]);
//     $class = ClassMaster::findOrFail($id);
//     $class->update($request->all());

//  return redirect('class-masters')->with('success', 'Center updated successfully.');
// }

//updaty ewith gile diocs


public function update(Request $request, string $id)
{
    $request->validate([
        'class_name' => 'required',
        'amount_of_children' => 'required',
    ]);

    $class = ClassMaster::findOrFail($id);

    $data = $request->all();

    // If a new file is uploaded, handle it
    if ($request->hasFile('classroom_schedules')) {
        $file = $request->file('classroom_schedules');
        $filename = time() . '_schedule_' . $file->getClientOriginalName();
        $file->move(public_path('uploads'), $filename);

        $data['classroom_schedules'] = '/public/uploads/' . $filename;
    }

    $class->update($data);

    return redirect('class-masters')->with('success', 'Class updated successfully.');
}


    public function destroy(string $id)
    {
        $center = ClassMaster::findOrFail($id);
        $center->delete();
                return redirect('class-masters')->with('success', 'class deleted successfully.');
    }
    
    
      public function boot() {
        DB::enableQueryLog();
    }
    
    //gallry
    
//       public function showChildren($class_id)
// {
//     $class = ClassMaster::with(['children'])->findOrFail($class_id);

//     return view('class_masters.class_children', compact('class'));
// }

public function showChildren($class_id)
{
    $user = session('user');

    $class = ClassMaster::with(['children', 'center'])->findOrFail($class_id);

    // Manager can only view their center's classes
    if ($user['user_type'] === 'Manager' && $class->center_id != $user['center_id']) {
        abort(403, 'Unauthorized access to this class.');
    }

    return view('class_masters.children', compact('class', 'user'));
}


 
   
    public function gallery($id)
{
    $class = \App\Models\ClassMaster::findOrFail($id);
    $uploads = $class->other_file_doc ? json_decode($class->other_file_doc, true) : [];

    return view('class_masters.gallery', compact('class', 'uploads'));
}

public function uploadGallery(\Illuminate\Http\Request $request, $id)
{
    $request->validate([
        'file_title' => 'required|string|max:255',
        'gallery_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $class = \App\Models\ClassMaster::findOrFail($id);

    $file = $request->file('gallery_file');
    $filename = time() . '_' . $file->getClientOriginalName();
    $folderPath = '/uploads/class_' . $class->class_id;

    if (!file_exists(public_path($folderPath))) {
        mkdir(public_path($folderPath), 0777, true);
    }

    $file->move(public_path($folderPath), $filename);

    $entry = [
        'title' => $request->file_title,
        'path' => $folderPath . '/' . $filename,
    ];

    $existing = $class->other_file_doc ? json_decode($class->other_file_doc, true) : [];
    $existing[] = $entry;

    $class->other_file_doc = json_encode($existing);
    $class->save();

    return redirect()->route('class_masters.gallery', $id)->with('success', 'File uploaded successfully!');
}

//UPDATE & DLEETE GALLERY  DOCS 
public function updateGallery(\Illuminate\Http\Request $request, $id, $fileIndex)
{
$request->validate([
'gallery_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
]);

$class = \App\Models\ClassMaster::findOrFail($id);
$uploads = $class->other_file_doc ? json_decode($class->other_file_doc, true) : [];

if (isset($uploads[$fileIndex])) {
// Delete old file
$oldPath = public_path($uploads[$fileIndex]['path']);
if (file_exists($oldPath)) {
unlink($oldPath);
}

// Upload new file
$file = $request->file('gallery_file');
$filename = time() . '_' . $file->getClientOriginalName();
$folderPath = '/uploads/class_' . $class->class_id;

if (!file_exists(public_path($folderPath))) {
mkdir(public_path($folderPath), 0777, true);
}

$file->move(public_path($folderPath), $filename);

// Update entry
$uploads[$fileIndex]['path'] = $folderPath . '/' . $filename;

$class->other_file_doc = json_encode($uploads);
$class->save();
}

return redirect()->route('class_masters.gallery', $id)->with('success', 'File updated successfully!');
}



public function deleteGallery($id, $fileIndex)
{
$class = \App\Models\ClassMaster::findOrFail($id);
$uploads = $class->other_file_doc ? json_decode($class->other_file_doc, true) : [];

if (isset($uploads[$fileIndex])) {
// Delete file from storage
$filePath = public_path($uploads[$fileIndex]['path']);
if (file_exists($filePath)) {
unlink($filePath);
}

// Remove from JSON
array_splice($uploads, $fileIndex, 1);
$class->other_file_doc = json_encode($uploads);
$class->save();
}

return redirect()->route('class_masters.gallery', $id)->with('success', 'File deleted successfully!');
}
}
