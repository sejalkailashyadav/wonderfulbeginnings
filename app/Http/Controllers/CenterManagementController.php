<?php

namespace App\Http\Controllers;

use App\Models\CenterManagements;
use App\Models\ClassMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class CenterManagementController extends Controller
{
    // public function index()
    // {
    //     // $centers = CenterManagements::all(); // fetch all records
    //     $centers = \App\Models\CenterManagements::withCount(['classes', 'children'])->get();
    //     return view('center_managements.index', compact('centers'));
    // }

    public function create()
    {
        return view('center_managements.create');
    }

    //ADMIN &b MANGER ACCES ''

    // public function index()
// {

    //     //dd($user);


    //     // } else {

    //     // if ($user['role'] != 'Admin') {
//     //     // If Manager, show only his center
//     //     $centers = CenterManagements::withCount(['classes', 'children'])
//     //                 ->where('center_id', $user['center_id'])
//     //                 ->get();
//     // }
//     // if ($user['role'] == 'Admin') 
//     // {
//     //     $centers = CenterManagements::withCount(['classes', 'children'])->get();
//     // }


    //  $user = session('user'); // make sure user is in session

    //     if ($user['role'] === 'Admin') {
//         // Admin sees all centers
//         $centers = CenterManagements::all();
//     } else {
//         // Manager sees only their center
//         $centers = CenterManagements::where('center_id', $user['center_id'])->get();
//     }



    //     return view('center_managements.index', compact('centers', 'user'));
// }
    public function index()
    {
        $user = session('user');

        if ($user['user_type'] === 'Admin') {
            // Admin sees all centers
            $centers = CenterManagements::withCount(['classes', 'children'])->get();
        } else {
            // Manager sees only their center
            $centers = CenterManagements::withCount(['classes', 'children'])
                ->where('center_id', $user['center_id'])
                ->get();
        }
        return view('center_managements.index', compact('centers', 'user'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'center_name' => 'required|string|max:255',
            'center_address' => 'required|string|max:255',
            'center_email' => 'required|email|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10,15}$/',
            'license_number' => 'required|string|max:50',
            'g_number' => 'required|string|max:50',
            'facility_number' => 'required|string|max:50',
            'licensing_officer_name' => 'required|string|max:255',
            'licensing_officer_email' => 'required|email|max:255',
            'licensing_officer_mobile' => 'required|regex:/^[0-9]{10,15}$/',
            'business_license_doc' => 'nullable|file|mimes:pdf',
            'facility_license_doc' => 'nullable|file|mimes:pdf',
            'incorporation_doc' => 'nullable|file|mimes:pdf',
            'other_file_doc' => 'nullable|file|mimes:pdf',
            'number_of_classrooms' => 'required|integer|min:1|max:100',
            'ccof' => 'nullable|file|mimes:pdf',
            'inspection_reports' => 'nullable|file|mimes:pdf',
        ]);
        $data = $request->all();


        if ($request->hasFile('business_license_doc')) {
            $file = $request->file('business_license_doc');
            $filename = time() . '_business_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['business_license_doc'] = '/public/uploads/' . $filename;
        }

        if ($request->hasFile('facility_license_doc')) {
            $file = $request->file('facility_license_doc');
            $filename = time() . '_facility_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['facility_license_doc'] = '/public/uploads/' . $filename;
        }

        if ($request->hasFile('incorporation_doc')) {
            $file = $request->file('incorporation_doc');
            $filename = time() . '_incorporation_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['incorporation_doc'] = '/public/uploads/' . $filename;
        }

        if ($request->hasFile('other_file_doc')) {
            $file = $request->file('other_file_doc');
            $filename = time() . '_other_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['other_file_doc'] = '/public/uploads/' . $filename;
        }

         if ($request->hasFile('ccof')) {
            $file = $request->file('ccof');
            $filename = time() . '_ccof_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['ccof'] = '/public/uploads/' . $filename;
        }

        if ($request->hasFile('inspection_reports')) {
            $file = $request->file('inspection_reports');
            $filename = time() . '_inspection_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['inspection_reports'] = '/public/uploads/' . $filename;
        }

        $data['number_of_classrooms'] = $request->number_of_classrooms;


        $center = CenterManagements::create($data);


        if ($request->number_of_classrooms) {
            for ($i = 1; $i <= $request->number_of_classrooms; $i++) {
                \App\Models\ClassMaster::create([
                    'class_name' => 'Classroom ' . $i,
                    'center_id' => $center->center_id,
                    'amount_of_children' => 0,
                    'total_currently_enrolled' => 0,
                    'classroom_schedules' => 'upload doc'
                ]);
            }
        }

        return redirect('center-managements')->with('success', 'Center created successfully!');
    }





    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $center = CenterManagements::findOrFail($id);
        return view('center_managements.edit', compact('center'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'center_name' => 'required|string|max:255',
    //         'center_address' => 'required|string|max:255',
    //         'center_email' => 'required|email|max:255',
    //     ]);

    //     $center = CenterManagements::findOrFail($id);
    //     $center->update($request->all());

    //     return redirect('center-managements')->with('success', 'Center updated successfully.');
    // }


    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'center_name' => 'required|string|max:255',
            // 'center_address' => 'required|string|max:255',
            // 'center_email' => 'required|email|max:255'
            // // // Optional: validate file types/sizes
            // // 'business_license_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // // 'facility_license_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // // 'incorporation_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            // // 'other_file_doc' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            //updateed validatiosn

            'center_name' => 'required|string|max:255',
            'center_address' => 'required|string|max:255',
            'center_email' => 'required|email|max:255',
            'phone_number' => 'nullable|regex:/^[0-9]{10,15}$/',
            'license_number' => 'nullable|string|max:50',
            'g_number' => 'nullable|string|max:50',
            'licensing_officer_name' => 'nullable|string|max:255',
            'licensing_officer_email' => 'nullable|email|max:255',
            'licensing_officer_mobile' => 'nullable|regex:/^[0-9]{10,15}$/',
            'business_license_doc' => 'nullable|file|mimes:pdf|max:2048',
            'facility_license_doc' => 'nullable|file|mimes:pdf|max:2048',
            'incorporation_doc' => 'nullable|file|mimes:pdf|max:2048',
            'other_file_doc' => 'nullable|file|mimes:pdf|max:2048',
            'number_of_classrooms' => 'required|integer|min:1|max:100',
             'ccof' => 'nullable|file|mimes:pdf',
            'inspection_reports' => 'nullable|file|mimes:pdf',
        ]);

        $center = CenterManagements::findOrFail($id);
        $data = $request->all();

        // handle file updates
        if ($request->hasFile('business_license_doc')) {
            $file = $request->file('business_license_doc');
            $filename = time() . '_business_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['business_license_doc'] = '/public/uploads/' . $filename;
        }

        if ($request->hasFile('facility_license_doc')) {
            $file = $request->file('facility_license_doc');
            $filename = time() . '_facility_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['facility_license_doc'] = '/public/uploads/' . $filename;
        }

        if ($request->hasFile('incorporation_doc')) {
            $file = $request->file('incorporation_doc');
            $filename = time() . '_incorporation_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['incorporation_doc'] = '/public/uploads/' . $filename;
        }

        if ($request->hasFile('other_file_doc')) {
            $file = $request->file('other_file_doc');
            $filename = time() . '_other_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['other_file_doc'] = '/public/uploads/' . $filename;
        }

         if ($request->hasFile('ccof')) {
            $file = $request->file('ccof');
            $filename = time() . '_ccof_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['ccof'] = '/public/uploads/' . $filename;
        }

        if ($request->hasFile('inspection_reports')) {
            $file = $request->file('inspection_reports');
            $filename = time() . '_inspection_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $data['inspection_reports'] = '/public/uploads/' . $filename;
        }


        // update center
        $center->update($data);


        // handle classrooms update
        if ($request->has('number_of_classrooms')) {
            $newCount = (int) $request->number_of_classrooms;
            $currentCount = $center->classes()->count(); // relationship assumed

            if ($newCount > $currentCount) {
                // Add missing classrooms
                for ($i = $currentCount + 1; $i <= $newCount; $i++) {
                    \App\Models\ClassMaster::create([
                        'class_name' => 'Classroom ' . $i,
                        'center_id' => $center->center_id,
                        'amount_of_children' => 0,
                        'total_currently_enrolled' => 0,
                        'classroom_schedules' => 'upload doc'
                    ]);
                }
            } elseif ($newCount < $currentCount) {
                // Remove extra classrooms
                $classesToDelete = $center->classes()
                    ->orderByDesc('class_id') // delete latest first
                    ->take($currentCount - $newCount)
                    ->get();

                foreach ($classesToDelete as $class) {
                    $class->delete();
                }
            }
        }



        return redirect('center-managements')->with('success', 'Center updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $center = CenterManagements::findOrFail($id);
    //     $center->delete();

    //     return redirect('center-managements')->with('success', 'Center deleted successfully.');
    // }

    //     public function destroy(string $id)
// {
//     $center = CenterManagements::findOrFail($id);

    //     // Check if center has any related classes
//     $hasClasses = ClassMaster::where('center_id', $center->center_id)->exists();

    //     if ($hasClasses) {
//         return redirect()->back()->with('error', 'Cannot delete this center. One or more classes are assigned to it.');
//     }

    //     $center->delete();

    //     return redirect('center-managements')->with('success', 'Center deleted successfully.');
// }

    public function destroy(string $id)
    {
        $center = CenterManagements::findOrFail($id);

        // Check if center has any related classes
        $hasClasses = ClassMaster::where('center_id', $center->center_id)->exists();

        if ($hasClasses) {
            return redirect()->back()->with('error', 'Cannot delete this center. One or more classes are assigned to it.');
        }

        $center->delete();

        return redirect('center-managements')->with('success', 'Center deleted successfully.');
    }

    public function boot()
    {
        DB::enableQueryLog();
    }



    public function gallery($id)
    {
        $center = \App\Models\CenterManagements::findOrFail($id);
        $uploads = $center->other_file_doc ? json_decode($center->other_file_doc, true) : [];

        return view('center_managements.gallery', compact('center', 'uploads'));
    }

    public function uploadGallery(\Illuminate\Http\Request $request, $id)
    {
        $request->validate([
            'file_title' => 'required|string|max:255',
            'gallery_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $center = \App\Models\CenterManagements::findOrFail($id);

        $file = $request->file('gallery_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $folderPath = '/uploads/center_' . $center->center_id;

        if (!file_exists(public_path($folderPath))) {
            mkdir(public_path($folderPath), 0777, true);
        }

        $file->move(public_path($folderPath), $filename);

        $entry = [
            'title' => $request->file_title,
            'path' => $folderPath . '/' . $filename,
        ];

        $existing = $center->other_file_doc ? json_decode($center->other_file_doc, true) : [];
        $existing[] = $entry;

        $center->other_file_doc = json_encode($existing);
        $center->save();

        return redirect()->route('center_managements.gallery', $id)->with('success', 'File uploaded successfully!');
    }

        // public function updateGallery(\Illuminate\Http\Request $request, $id, $fileIndex)
        // {
        //     $request->validate([
        //         'file_title' => 'required|string|max:255',
        //     ]);
        
        //     $center = \App\Models\CenterManagements::findOrFail($id);
        //     $uploads = $center->other_file_doc ? json_decode($center->other_file_doc, true) : [];
        
        //     if (isset($uploads[$fileIndex])) {
        //         $uploads[$fileIndex]['title'] = $request->file_title;
        //         $center->other_file_doc = json_encode($uploads);
        //         $center->save();
        //     }
        
        //     return redirect()->route('center_managements.gallery', $id)->with('success', 'File updated successfully!');
        // }
        
        public function updateGallery(\Illuminate\Http\Request $request, $id, $fileIndex)
{
    $request->validate([
        'gallery_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $center = \App\Models\CenterManagements::findOrFail($id);
    $uploads = $center->other_file_doc ? json_decode($center->other_file_doc, true) : [];

    if (isset($uploads[$fileIndex])) {
        // Delete old file
        $oldPath = public_path($uploads[$fileIndex]['path']);
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }

        // Upload new file
        $file = $request->file('gallery_file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $folderPath = '/uploads/center_' . $center->center_id;

        if (!file_exists(public_path($folderPath))) {
            mkdir(public_path($folderPath), 0777, true);
        }

        $file->move(public_path($folderPath), $filename);

        // Update entry
        $uploads[$fileIndex]['path'] = $folderPath . '/' . $filename;

        $center->other_file_doc = json_encode($uploads);
        $center->save();
    }

    return redirect()->route('center_managements.gallery', $id)->with('success', 'File updated successfully!');
}


        
        public function deleteGallery($id, $fileIndex)
        {
            $center = \App\Models\CenterManagements::findOrFail($id);
            $uploads = $center->other_file_doc ? json_decode($center->other_file_doc, true) : [];
        
            if (isset($uploads[$fileIndex])) {
                // Delete file from storage
                $filePath = public_path($uploads[$fileIndex]['path']);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
        
                // Remove from JSON
                array_splice($uploads, $fileIndex, 1);
                $center->other_file_doc = json_encode($uploads);
                $center->save();
            }
        
            return redirect()->route('center_managements.gallery', $id)->with('success', 'File deleted successfully!');
        }


}
