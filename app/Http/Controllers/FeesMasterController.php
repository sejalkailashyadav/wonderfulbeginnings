<?php

namespace App\Http\Controllers;

use App\Models\FeesMasters;
use Illuminate\Http\Request;
use App\Models\CenterManagements;
use App\Models\ProgramMasters;
use App\Models\ProgramCreates;
use Illuminate\Support\Facades\DB;
use App\Models\ChildMasters;

class FeesMasterController extends Controller
{

    public function index()
    {
        $fees = DB::table('child_masters as ch')
            ->join('center_managments as cm', 'ch.center_id', '=', 'cm.center_id')
            ->join('program_masters as pm', 'ch.program_id', '=', 'pm.program_id')
            ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
            ->select(
                'cm.center_id',
                'cm.center_name',
                'cm.center_email',
                'ch.child_id',
                'ch.child_first_name',
                'ch.child_last_name',
                'ch.parent_first_name',
                'ch.parent_last_name',
                'ch.parent_email',
                'ch.parent_mobile',
                'ch.child_dob',
                'ch.admission_date',
                'ch.institution_number',
                'ch.transit_number',
                'ch.account_number',
                'pm.program_id',
                'pc.program_name',
                'ch.active_status',
                'pm.program_fees',
                'pm.ccfri',
                'pm.accb',
                'pm.parent_fees',
                'ch.number_of_days'
            )
            ->get();

        $centers = CenterManagements::all();
      // Get mapping of account_number to child_id
        $accountMap = DB::table('child_masters')
            ->select('account_number', 'child_id')
            ->whereNotNull('account_number')
            ->pluck('child_id', 'account_number') // Returns: [account_number => child_id]
            ->toArray();
        return view('fees_masters.index', compact('fees', 'centers','accountMap'));
    }

    //update store function 
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'month_year' => 'required',
    //         'center_id' => 'required|integer',
    //     ]);

    //     // Create new monthly report log
    //     $monthReportId = DB::table('monthly_report_logs')->insertGetId([
    //         'user_id' => 4, // Hardcoded for now; use auth()->id() in production
    //         'center_id' => $validated['center_id'],
    //         'month_year' => $validated['month_year'],
    //         'created_at' => now(),
    //     ]);

    //     // Fetch report data based on center
    //     $reportData = DB::table('child_masters as ch')
    //         ->join('center_managments as cm', 'ch.center_id', '=', 'cm.center_id')
    //         ->join('program_masters as pm', 'ch.program_id', '=', 'pm.program_id')
    //         ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
    //         ->where('ch.center_id', $validated['center_id'])
    //         ->select(
    //             'cm.center_name',
    //             'pc.program_name',
    //             DB::raw("CONCAT(ch.child_first_name, ' ', ch.child_last_name) as child_name"),
    //             DB::raw("CONCAT(ch.parent_first_name, ' ', ch.parent_last_name) as parent_name"),
    //             'ch.child_dob as date_of_birth',
    //             'ch.number_of_days',
    //             'pm.program_fees as total_fees',
    //             'pm.ccfri',
    //             'pm.accb',
    //             'pm.parent_fees as received_parent_fees',
    //             'ch.institution_number as institution_number',
    //             'ch.transit_number as transit_number',
    //             'ch.account_number as account_number'
    //         )
    //         ->get();

    //     // Insert each child record into all_report_logs
    //     foreach ($reportData as $row) {
    //         DB::table('all_report_logs')->insert([
    //             'center_name' => $row->center_name,
    //             'program_name' => $row->program_name,
    //             'child_name' => $row->child_name,
    //             'parent_name' => $row->parent_name,
    //             'date_of_birth' => $row->date_of_birth,
    //             'number_of_days' => $row->number_of_days,
    //             'total_fees' => $row->total_fees,
    //             'ccfri' => $row->ccfri,
    //             'accb' => $row->accb,
    //             'received_parent_fees' => $row->received_parent_fees,
    //             'institution_number' => $row->institution_number,
    //             'transit_number' => $row->transit_number,
    //             'account_number' => $row->account_number,
    //             'month_report_id' => $monthReportId,
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }

    //    return redirect()->back()->with('success', 'Monthly report stored successfully.');
    // }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'month_year' => 'required',
            'center_id' => 'required|integer',
            'report_name' =>  'required',
        ]);

        $centerId = $validated['center_id'];
        $monthYear = $validated['month_year'];
       $report_name = $validated['report_name'];
 
       // Split month and year
    [$year, $month] = explode('-', $monthYear);

        //  Check if center-related fees data exists
        $fesssData = FeesMasters::where('center_id', $centerId)->first();

        if (!$fesssData) {
            return redirect()->back()->with('error', 'Center data is not available.');
        }

        //  Create monthly report log
        $monthReportId = DB::table('monthly_report_logs')->insertGetId([
            'user_id' => auth()->id() ?? 4, // Use auth()->id() in real system
            'center_id' => $centerId,
            'month_year' => $monthYear,
            'report_name' => $report_name,
            'created_at' => now(),
        ]);

        //  Fetch report data for center 
        // $reportData = DB::table('child_masters as ch')
        //     ->join('center_managments as cm', 'ch.center_id', '=', 'cm.center_id')
        //     ->join('program_masters as pm', 'ch.program_id', '=', 'pm.program_id')
        //     ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
        //     ->where('ch.center_id', $centerId)
        //     ->select(
        //         'cm.center_name',
        //         'pc.program_name',
        //         DB::raw("CONCAT(ch.child_first_name, ' ', ch.child_last_name) as child_name"),
        //         DB::raw("CONCAT(ch.parent_first_name, ' ', ch.parent_last_name) as parent_name"),
        //         'ch.child_dob as date_of_birth',
        //         'ch.number_of_days',
        //           'ch.admission_date',
        //         'pm.program_fees as total_fees',
        //         'pm.ccfri',
        //         'pm.accb',
        //         'pm.parent_fees as received_parent_fees',
        //         'ch.institution_number',
        //         'ch.transit_number',
        //         'ch.account_number'
        //     )
        //     ->get();

        //thsi at  for month & center 
        
    $reportData = DB::table('child_masters as ch')
        ->join('center_managments as cm', 'ch.center_id', '=', 'cm.center_id')
        ->join('program_masters as pm', 'ch.program_id', '=', 'pm.program_id')
        ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
        ->where('ch.center_id', $centerId)
        ->whereMonth('ch.admission_date', $month)
        ->whereYear('ch.admission_date', $year)
        ->select(
            'cm.center_name',
            'pc.program_name',
            DB::raw("CONCAT(ch.child_first_name, ' ', ch.child_last_name) as child_name"),
            DB::raw("CONCAT(ch.parent_first_name, ' ', ch.parent_last_name) as parent_name"),
            'ch.child_dob as date_of_birth',
            'ch.number_of_days',
            'ch.admission_date',
            'pm.program_fees as total_fees',
            'pm.ccfri',
            'pm.accb',
            'pm.parent_fees as received_parent_fees',
            'ch.institution_number',
            'ch.transit_number',
            'ch.account_number'
        )
        ->get();

        foreach ($reportData as $row) {
            DB::table('all_report_logs')->insert([
                'center_name' => $row->center_name,
                'program_name' => $row->program_name,
                'child_name' => $row->child_name,
                'parent_name' => $row->parent_name,
                'date_of_birth' => $row->date_of_birth,
                'number_of_days' => $row->number_of_days,
                'total_fees' => $row->total_fees,
                'ccfri' => $row->ccfri,
                'accb' => $row->accb,
                'admission_date' => $row->admission_date,
                'received_parent_fees' => $row->received_parent_fees,
                'institution_number' => $row->institution_number,
                'transit_number' => $row->transit_number,
                'account_number' => $row->account_number,
                'month_report_id' => $monthReportId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Monthly report stored successfully.');
    }



//selected id & month   

    public function getCenterData($id)
    {
        $data = DB::table('child_masters as ch')
            ->join('center_managments as cm', 'ch.center_id', '=', 'cm.center_id')
            ->join('program_masters as pm', 'ch.program_id', '=', 'pm.program_id')
            ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
            ->where('ch.center_id', $id)
            ->select(
                'cm.center_id',
                'cm.center_name',
                'cm.center_email',
                'ch.child_id',
                'ch.child_first_name',
                'ch.child_last_name',
                'ch.parent_first_name',
                'ch.parent_last_name',
                'ch.parent_email',
                 'ch.admission_date',
                'ch.parent_mobile',
                'ch.child_dob',
                'ch.institution_number',
                'ch.transit_number',
                'ch.account_number',
                  'ch.active_status',
                'pm.program_id',
                'pc.program_name',
                'pm.program_fees',
                'pm.ccfri',
                'pm.accb',
                'pm.parent_fees',
                'ch.number_of_days'
            )
            ->get();

        return response()->json($data);
    }



    public function getCentersByMonth(Request $request)
    {
        $request->validate([
            'month_year' => 'required|date_format:Y-m',
        ]);

        $monthYear = $request->month_year;

        // Fetch distinct centers with data in the selected month
        $centerIds = FeesMasters::where('month_year', $monthYear)
            ->pluck('center_id')
            ->unique();

        $centers = CenterManagements::whereIn('center_id', $centerIds)->get();

        return response()->json($centers);
    }

    
    //show report based on center id 
// public function getReportData($centerId = null)
// {
//     $query = DB::table('child_masters as ch')
//         ->join('center_managments as cm', 'ch.center_id', '=', 'cm.center_id')
//         ->join('program_masters as pm', 'ch.program_id', '=', 'pm.program_id')
//         ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
//         ->select(
//             'cm.center_name',
//             'pc.program_name',
//             'ch.child_first_name',
//             'ch.child_last_name',
//             'ch.parent_first_name',
//             'ch.parent_last_name',
//              'ch.admission_date',
//             'ch.child_dob',
//               'ch.active_status',
//             'ch.number_of_days',
//             'pm.program_fees',
//             'pm.ccfri',
//             'pm.accb',
//             'pm.parent_fees',
//             'ch.institution_number',
//             'ch.transit_number',
//             'ch.account_number'
//         );

//     if ($centerId !== null) {
//         $query->where('ch.center_id', $centerId);
//     }

    
//     return response()->json($query->get());
// }


//nwe udate qith month name &  center if filter 


public function getReportData(Request $request)
{
    $centerId = $request->query('centerId');
    $month = $request->query('month'); // e.g. '2025-05'

    $query = DB::table('child_masters as ch')
        ->join('center_managments as cm', 'ch.center_id', '=', 'cm.center_id')
        ->join('program_masters as pm', 'ch.program_id', '=', 'pm.program_id')
        ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
        ->select(
            'cm.center_name',
            'pc.program_name',
            'ch.child_first_name',
            'ch.child_last_name',
            'ch.parent_first_name',
            'ch.parent_last_name',
            'ch.admission_date',
            'ch.child_dob',
            'ch.active_status',
            'ch.number_of_days',
            'pm.program_fees',
            'pm.ccfri',
            'pm.accb',
            'pm.parent_fees',
            'ch.institution_number',
            'ch.transit_number',
            'ch.account_number'
        );

    if ($centerId) {
        $query->where('ch.center_id', $centerId);
    }

    if ($month) {
        $query->whereRaw("DATE_FORMAT(ch.admission_date, '%Y-%m') = ?", [$month]);
    }

    return response()->json($query->get());
}

    // public function getReportData(Request $request)
    // {
    //     $request->validate([
    //         'month_year' => 'required|date_format:Y-m',
    //         'center_id' => 'required|integer',
    //     ]);

    //     $month = $request->month_year;
    //     $centerId = $request->center_id;

    //     $data = DB::table('child_masters as ch')
    //         ->join('center_managments as cm', 'ch.center_id', '=', 'cm.center_id')
    //         ->join('program_masters as pm', 'ch.program_id', '=', 'pm.program_id')
    //         ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
    //         ->where('ch.center_id', $centerId)
    //         ->select(
    //             'cm.center_name',
    //             'pc.program_name',
    //             DB::raw("CONCAT(ch.child_first_name, ' ', ch.child_last_name) as child_name"),
    //             DB::raw("CONCAT(ch.parent_first_name, ' ', ch.parent_last_name) as parent_name"),
    //             'ch.child_dob as date_of_birth',
    //             'ch.number_of_days',
    //             'pm.program_fees as total_fees',
    //             'pm.ccfri',
    //             'pm.accb',
    //             'pm.parent_fees as received_parent_fees',
    //             'ch.institution_number',
    //             'ch.transit_number',
    //             'ch.account_number'
    //         )
    //         ->get();

    //     return response()->json($data);
    // }

    //new no of days 
    public function edit($child_id)
    {
        $child = DB::table('child_masters')->where('child_id', $child_id)->first();

        // Get matching program_masters row (pm2)
        $program = DB::table('program_masters')
            ->where('create_id', $child->Program_id)
            ->where('number_of_days', $child->number_of_days)
            ->where('center_id', $child->center_id)
            ->first();

        return view('fees_masters.edit', compact('child', 'program'));
    }

    public function update(Request $request, $child_id)
    {
        $child = DB::table('child_masters')->where('child_id', $child_id)->first();

        // Step 2: Update matching program_masters (pm2)
        DB::table('program_masters')
            ->where('create_id', $child->Program_id)
            ->where('number_of_days', $child->number_of_days)
            ->where('center_id', $child->center_id)
            ->update([
                'ACCB' => $request->ACCB,
            ]);
        DB::enableQueryLog(); // Start logging

        DB::table('program_masters')
            ->where('create_id', $child->Program_id)
            ->where('number_of_days', $child->number_of_days)
            ->where('center_id', $child->center_id)
            ->update([
                'ACCB' => $request->ACCB,
            ]);

        //  Log output
        dd(DB::getQueryLog());
        return redirect()->route('fees-masters.edit', ['child_id' => $child_id])
            ->with('success', 'Data updated successfully!');
        // return redirect()->route('fees-masters.edit')->with('success', 'Data updated successfully!');
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
        FeesMasters::destroy($id);
        return redirect('fees-masters')->with('success', 'Fee record deleted successfully.');
    }

    //new accb recived
    public function updateAccb(Request $request)
    {
        DB::table('child_masters')
            ->where('child_id', $request->child_id)
            ->update(['accb' => $request->accb]);

        return response()->json(['status' => 'success']);
    }


}
