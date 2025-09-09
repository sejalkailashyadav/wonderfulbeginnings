<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CenterManagements;
use App\Models\CurrentChildMaster;
use App\Models\ChildMonthlyReport;
use App\Models\CenterMonthReport;
use App\Models\CurrentFeesMaster;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Response;
use App\Models\ClassMaster;

class CenterMonthReportController extends Controller
{
    // public function index()
    // {
    //     $centers = CenterManagements::all();
    //     return view('reports.center_month_filter', compact('centers'));
    // }
    
    //mager & Admin 
    
    
    public function index()
{
    $user = session('user');

    if ($user->user_type === 'Admin') {
        $centers = CenterManagements::all();
    } else {
        $centers = CenterManagements::where('center_id', $user->center_id)->get();
    }

    return view('reports.center_month_filter', compact('centers'));
}


//     public function filterChildren(Request $request)
//     {
//         $request->validate([
//             'center_id' => 'required|integer',
//             'class_id' => 'required|integer',
//             'report_month' => 'required|date_format:Y-m'
//         ]);

//         $centerMonthReport = CenterMonthReport::firstOrCreate([
//             'center_id' => $request->center_id,
//             'report_month' => $request->report_month
//         ]);

//         $existingReports = ChildMonthlyReport::with([
//             'child', 'child.center', 'child.class', 'child.fee'
//         ])
//         ->where('center_id', $request->center_id)
//         ->where('month', $request->report_month)
//         ->whereHas('child', function ($q) use ($request) {
//             $q->where('class_id', $request->class_id);
//         })->get();

//         if ($existingReports->isNotEmpty()) {
//             $children = $existingReports; // show saved reports
//         } else {
//             // $children = CurrentChildMaster::with(['center', 'class', 'fee'])
//             //     ->where('center_id', $request->center_id)
//             //     ->where('class_id', $request->class_id)
//             //     ->whereMonth('created_at', date('m', strtotime($request->report_month)))
//             //     ->whereYear('created_at', date('Y', strtotime($request->report_month)))
//             //     ->get();

// //now 
// $children = CurrentChildMaster::with(['center', 'class', 'fee'])
//     ->where('center_id', $request->center_id)
//     ->where('class_id', $request->class_id)
//     ->where('status', '!=', 3) // ✅ Exclude status -3
//     // ->whereMonth('created_at', date('m', strtotime($request->report_month)))
//     // ->whereYear('created_at', date('Y', strtotime($request->report_month)))
//     ->get();

//             foreach ($children as $child) {
//                 ChildMonthlyReport::updateOrCreate(
//                     [
//                         'child_id' => $child->child_id,
//                         'center_id' => $child->center_id,
//                         'month' => $request->report_month
//                     ],
//                     [
//                         'class_id' => $child->class_id,
//                         'monthly_fee' => $child->fee->monthly_fees ?? 0,
//                         'ccfri' => $child->fee->ccfri ?? 0,
//                         'accb' => $child->fee->accb ?? 0, 
//                          'total' => ($child->fee->monthly_fees ?? 0) - 
//                   (($child->fee->ccfri ?? 0) + ($child->fee->accb ?? 0)),
  
//                     ]
//                 );
//             }

//             $children = ChildMonthlyReport::with([
//                 'child', 'child.center', 'child.class', 'child.fee'
//             ])
//             ->where('center_id', $request->center_id)
//             ->where('month', $request->report_month)
//             ->whereHas('child', function ($q) use ($request) {
//                 $q->where('class_id', $request->class_id);
//             })->get();
//         }

//         return view('reports.center_month_filter_result', [
//             'children' => $children,
//             'center_id' => $request->center_id,
//             'class_id' => $request->class_id,
//             'report_month' => $request->report_month
//         ]);
//     }

//now worklimg but class deddd today yyyyyyyyyyyy
//     public function filterChildren(Request $request)
//     {
//         $request->validate([
//             'center_id' => 'required|integer',
//             'class_id' => 'required|integer',
//             'report_month' => 'required|date_format:Y-m'
//         ]);

//         $centerMonthReport = CenterMonthReport::firstOrCreate([
//             'center_id' => $request->center_id,
//             'report_month' => $request->report_month
//         ]);

//         $existingReports = ChildMonthlyReport::with([
//             'child', 'child.center', 'child.class', 'child.fee'
//         ])
//         ->where('center_id', $request->center_id)
//         ->where('month', $request->report_month)
//         ->whereHas('child', function ($q) use ($request) {
//             $q->where('class_id', $request->class_id);
//         })->get();

//         if ($existingReports->isNotEmpty()) {
//             $children = $existingReports; // show saved reports
//         } else {

// // $children = CurrentChildMaster::with(['center', 'class', 'fee'])
// //     ->where('center_id', $request->center_id)
// //     ->where('class_id', $request->class_id)
// //     ->where('status', '!=', 3 ) 
// //     ->get();
// $children = CurrentChildMaster::with(['center', 'class', 'fee'])
//     ->where('center_id', $request->center_id)
//     ->where('class_id', $request->class_id)
//     ->whereIn('status', [1, 2]) // Only Active or Withdrawal
//     ->get();


//             foreach ($children as $child) {
//                 ChildMonthlyReport::updateOrCreate(
//                     [
//                         'child_id' => $child->child_id,
//                         'center_id' => $child->center_id,
//                         'month' => $request->report_month
//                     ],
//                     [
//                         'class_id' => $child->class_id,
//                         'monthly_fee' => $child->fee->monthly_fees ?? 0,
//                         'ccfri' => $child->fee->ccfri ?? 0,
//                         'accb' => $child->fee->accb ?? 0, 
//                         'status' => $child->status ?? 0, 
//                          'total' => ($child->fee->monthly_fees ?? 0) - 
//                   (($child->fee->ccfri ?? 0) + ($child->fee->accb ?? 0)),
  
//                     ]
//                 );
//             }

//             $children = ChildMonthlyReport::with([
//                 'child', 'child.center', 'child.class', 'child.fee'
//             ])
//             ->where('center_id', $request->center_id)
//             ->where('month', $request->report_month)
//             ->whereHas('child', function ($q) use ($request) {
//                 $q->where('class_id', $request->class_id);
//             })->get();
//         }

//         return view('reports.center_month_filter_result', [
//             'children' => $children,
//             'center_id' => $request->center_id,
//             'class_id' => $request->class_id,
//             'report_month' => $request->report_month
//         ]);
//     }
    
    
    //here class not needed  
    
    
//     public function filterChildren(Request $request)
// {
//     $request->validate([
//         'center_id' => 'required|integer',
//         'report_month' => 'required|date_format:Y-m',
//         'class_id' => 'nullable|integer',
//     ]);

//     // Create/Find center-month entry
//     $centerMonthReport = CenterMonthReport::firstOrCreate([
//         'center_id' => $request->center_id,
//         'report_month' => $request->report_month,
//     ]);

//     // Try to load saved reports
//     $existingReports = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
//         ->where('center_id', $request->center_id)
//         ->where('month', $request->report_month)
//         ->whereHas('child', function ($q) use ($request) {
//             $q->whereIn('status', [1, 2]);

//             if ($request->filled('class_id')) {
//                 $q->where('class_id', $request->class_id);
//             }
//         })->get();

//     if ($existingReports->isNotEmpty()) {
//         $children = $existingReports;
//     } else {
//         // Fetch fresh from CurrentChildMaster
//         $query = CurrentChildMaster::with(['center', 'class', 'fee'])
//             ->where('center_id', $request->center_id)
//             ->whereIn('status', [1, 2]);

//         if ($request->filled('class_id')) {
//             $query->where('class_id', $request->class_id);
//         }

//         $children = $query->get();

//         // Create monthly reports
//         foreach ($children as $child) {
//             ChildMonthlyReport::updateOrCreate(
//                 [
//                     'child_id' => $child->child_id,
//                     'center_id' => $child->center_id,
//                     'month' => $request->report_month
//                 ],
//                 [
//                     'class_id' => $child->class_id,
//                     'monthly_fee' => $child->fee->monthly_fees ?? 0,
//                     'ccfri' => $child->fee->ccfri ?? 0,
//                     'accb' => $child->fee->accb ?? 0,
//                     'status' => $child->status ?? 0,
//                     'total' => ($child->fee->monthly_fees ?? 0)
//                         - (($child->fee->ccfri ?? 0) + ($child->fee->accb ?? 0)),
//                 ]
//             );
//         }

//         // Load saved reports after creation
//         $children = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
//             ->where('center_id', $request->center_id)
//             ->where('month', $request->report_month)
//             ->whereHas('child', function ($q) use ($request) {
//                 $q->whereIn('status', [1, 2]);

//                 if ($request->filled('class_id')) {
//                     $q->where('class_id', $request->class_id);
//                 }
//             })->get();
//     }
//     $feePlans = CurrentFeesMaster::where('center_id', $request->center_id)->get();
    
//     return view('reports.center_month_filter_result', [
//         'children' => $children,
//         'center_id' => $request->center_id,
//         'class_id' => $request->class_id,
//         'report_month' => $request->report_month,
//          'feePlans' => $feePlans,
//     ]);
// }


///vlass wose filedter in drodwn editable 


///current cdee.........................
// public function filterChildren(Request $request)
// {
//     $request->validate([
//         'center_id' => 'required|integer',
//         'report_month' => 'required|date_format:Y-m',
//         'class_id' => 'nullable|integer',
//     ]);

//     // Create/Find center-month entry
//     $centerMonthReport = CenterMonthReport::firstOrCreate([
//         'center_id' => $request->center_id,
//         'report_month' => $request->report_month,
//     ]);

//     // Try to load saved reports
//     $existingReports = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
//         ->where('center_id', $request->center_id)
//         ->where('month', $request->report_month)
//         ->whereHas('child', function ($q) use ($request) {
//             $q->whereIn('status', [1, 2]);
//             if ($request->filled('class_id')) {
//                 $q->where('class_id', $request->class_id);
//             }
//         })->get();

//     if ($existingReports->isNotEmpty()) {
//         $children = $existingReports;
//     } else {
//         // Fetch fresh from CurrentChildMaster
//         $query = CurrentChildMaster::with(['center', 'class', 'fee'])
//             ->where('center_id', $request->center_id)
//             ->whereIn('status', [1, 2]);

//         if ($request->filled('class_id')) {
//             $query->where('class_id', $request->class_id);
//         }

//         $children = $query->get();

//         // Create monthly reports
//         foreach ($children as $child) {
//             ChildMonthlyReport::updateOrCreate(
//                 [
//                     'child_id' => $child->child_id,
//                     'center_id' => $child->center_id,
//                     'month' => $request->report_month
//                 ],
//                 [
//                     'class_id' => $child->class_id,
//                     'monthly_fee' => $child->fee->monthly_fees ?? 0,
//                     'ccfri' => $child->fee->ccfri ?? 0,
//                     'accb' => $child->fee->accb ?? 0,
//                     'status' => $child->status ?? 0,
//                     'total' => ($child->fee->monthly_fees ?? 0)
//                         - (($child->fee->ccfri ?? 0) + ($child->fee->accb ?? 0)),
//                 ]
//             );
//         }

//         // Reload reports after creation
//         $children = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
//             ->where('center_id', $request->center_id)
//             ->where('month', $request->report_month)
//             ->whereHas('child', function ($q) use ($request) {
//                 $q->whereIn('status', [1, 2]);
//                 if ($request->filled('class_id')) {
//                     $q->where('class_id', $request->class_id);
//                 }
//             })->get();
//     }

//     //  Get fee plans based on both center and (optional) class
//     $feePlansQuery = CurrentFeesMaster::where('center_id', $request->center_id);
//     if ($request->filled('class_id')) {
//         $feePlansQuery->where('class_id', $request->class_id);
//     }
//     $feePlans = $feePlansQuery->get();

//     return view('reports.center_month_filter_result', [
//         'children' => $children,
//         'center_id' => $request->center_id,
//         'class_id' => $request->class_id,
//         'report_month' => $request->report_month,
//         'feePlans' => $feePlans,
//     ]);
// }


//now ,,,,,,,,,,,,,,,,,,1/12/2025

// public function filterChildren(Request $request)
// {
//     $activeStatuses = [1, 2]; // add 3 if needed

//     // Get all active children from master
//     $allActiveChildren = CurrentChildMaster::with(['center', 'class', 'fee'])
//         ->where('center_id', $request->center_id)
//         ->whereIn('status', $activeStatuses)
//         ->when($request->filled('class_id'), function ($q) use ($request) {
//             $q->where('class_id', $request->class_id);
//         })
//         ->get();

//     // Get existing monthly reports
//     $existingReports = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
//         ->where('center_id', $request->center_id)
//         ->where('month', $request->report_month)
//         ->whereHas('child', function ($q) use ($request, $activeStatuses) {
//             $q->whereIn('status', $activeStatuses);
//             if ($request->filled('class_id')) {
//                 $q->where('class_id', $request->class_id);
//             }
//         })
//         ->get();

//     // Find missing children
//     $existingChildIds = $existingReports->pluck('child_id')->toArray();
//     $missingChildren = $allActiveChildren->whereNotIn('child_id', $existingChildIds);

//     // Create missing reports
//     foreach ($missingChildren as $child) {
//         ChildMonthlyReport::create([
//             'child_id'     => $child->child_id,
//             'center_id'    => $child->center_id,
//             'class_id'     => $child->class_id,
//             'month'        => $request->report_month,
//             'monthly_fee'  => $child->fee->monthly_fees ?? 0,
//             'ccfri'        => $child->fee->ccfri ?? 0,
//             'accb'         => $child->fee->accb ?? 0,
//             'status'       => $child->status ?? 0,
//             'total'        => ($child->fee->monthly_fees ?? 0) - (($child->fee->ccfri ?? 0) + ($child->fee->accb ?? 0)),
//         ]);
//     }

//     // Reload final monthly reports
//     $children = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
//         ->where('center_id', $request->center_id)
//         ->where('month', $request->report_month)
//         ->whereHas('child', function ($q) use ($request, $activeStatuses) {
//             $q->whereIn('status', $activeStatuses);
//             if ($request->filled('class_id')) {
//                 $q->where('class_id', $request->class_id);
//             }
//         })
//         ->get();

//     // Keep your original feePlans query
//     $feePlansQuery = CurrentFeesMaster::where('center_id', $request->center_id);
//     if ($request->filled('class_id')) {
//         $feePlansQuery->where('class_id', $request->class_id);
//     }
//     $feePlans = $feePlansQuery->get();

//     // Return with all original variables
//     return view('reports.center_month_filter_result', [
//         'children'     => $children,
//         'center_id'    => $request->center_id,
//         'class_id'     => $request->class_id,
//         'report_month' => $request->report_month,
//         'feePlans'     => $feePlans,
//     ]);
// }

//1/14/2025


public function filterChildren(Request $request)
{

     $request->validate([
         'center_id' => 'required|integer',
         'report_month' => 'required|date_format:Y-m',
         'class_id' => 'nullable|integer',
     ]);

     // Create/Find center-month entry
     $centerMonthReport = CenterMonthReport::firstOrCreate([
         'center_id' => $request->center_id,
         'report_month' => $request->report_month,
     ]);

    $activeStatuses = [1, 2]; // add 3 if needed

    // Get all active children from master
    $allActiveChildren = CurrentChildMaster::with(['center', 'class', 'fee'])
        ->where('center_id', $request->center_id)
        ->whereIn('status', $activeStatuses)
        ->when($request->filled('class_id'), function ($q) use ($request) {
            $q->where('class_id', $request->class_id);
        })
        ->get();

    // Get existing monthly reports
    $existingReports = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
        ->where('center_id', $request->center_id)
        ->where('month', $request->report_month)
        ->whereHas('child', function ($q) use ($request, $activeStatuses) {
            $q->whereIn('status', $activeStatuses);
            if ($request->filled('class_id')) {
                $q->where('class_id', $request->class_id);
            }
        })
        ->get();

       
        //  Sync institution/transit/account for existing reports
foreach ($existingReports as $report) {
    if ($report->child) {
        $report->update([
            'institution_number' => $report->child->institution_number,
            'transit_number'     => $report->child->transit_number,
            'account_number'     => $report->child->account_number,
        ]);
    }
}

    // Find missing children
    $existingChildIds = $existingReports->pluck('child_id')->toArray();
    $missingChildren = $allActiveChildren->whereNotIn('child_id', $existingChildIds);

    // Create missing reports
    foreach ($missingChildren as $child) {
        ChildMonthlyReport::create([
            'child_id'     => $child->child_id,
            'center_id'    => $child->center_id,
            'class_id'     => $child->class_id,
            'month'        => $request->report_month,
            'monthly_fee'  => $child->fee->monthly_fees ?? 0,
            'ccfri'        => $child->fee->ccfri ?? 0,
            'accb'         => $child->fee->accb ?? 0,
            'status'       => $child->status ?? 0,
            'institution_number' => $child->institution_number ?? 0,
            'transit_number' => $child->transit_number ?? 0,
            'account_number' => $child->account_number ?? 0,
            'total'        => ($child->fee->monthly_fees ?? 0) - (($child->fee->ccfri ?? 0) + ($child->fee->accb ?? 0)),
        ]);
    }

    // Reload final monthly reports
    $children = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
        ->where('center_id', $request->center_id)
        ->where('month', $request->report_month)
        ->whereHas('child', function ($q) use ($request, $activeStatuses) {
            $q->whereIn('status', $activeStatuses);
            if ($request->filled('class_id')) {
                $q->where('class_id', $request->class_id);
            }
        })
        ->get();

    // Keep your original feePlans query
    $feePlansQuery = CurrentFeesMaster::where('center_id', $request->center_id);
    if ($request->filled('class_id')) {
        $feePlansQuery->where('class_id', $request->class_id);
    }
    $feePlans = $feePlansQuery->get();

    // Return with all original variables
    return view('reports.center_month_filter_result', [
        'children'     => $children,
        'center_id'    => $request->center_id,
        'class_id'     => $request->class_id,
        'report_month' => $request->report_month,
        'feePlans'     => $feePlans,
    ]);
}

    public function edit($id)
    {
        $report = ChildMonthlyReport::with(['child'])->findOrFail($id);
        return view('reports.edit_monthly_report', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = ChildMonthlyReport::findOrFail($id);
        // $report->update([
        //     'monthly_fee' => $request->monthly_fee,
        //     'ccfri' => $request->ccfri,
        //     'total' => $request->monthly_fee - $request->ccfri
        // ]);
        $report->update([
    'monthly_fee' => $request->monthly_fee,
    'ccfri' => $request->ccfri,
    'accb' => $request->accb ?? 0, //  NEW
    'total' => $request->monthly_fee - ($request->ccfri + ($request->accb ?? 0)), //  NEW TOTAL
     'institution_number' => $request->institution_number ?? 0,
            'transit_number' => $request->transit_number ?? 0,
            'account_number' => $request->account_number ?? 0,
]);

return redirect()->route('center.month.filter')->with('success', 'Report updated successfully!');

        // return redirect()->back()->with('success', 'Report updated successfully!');
    }


public function exportHtmlExcel(Request $request)
{
    $center_id = $request->query('center_id');
    $class_id = $request->query('class_id');
    $report_month = $request->query('report_month');

    $children = CurrentChildMaster::with(['fee', 'class', 'center'])
        ->where('center_id', $center_id)
        ->where('class_id', $class_id)
        ->whereMonth('created_at', date('m', strtotime($report_month)))
        ->whereYear('created_at', date('Y', strtotime($report_month)))
        ->get();

    $filename = 'children_report_' . now()->format('Ymd_His') . '.xls';

    return response()->view('reports.export_html_excel', compact('children'))
        ->header('Content-Type', 'application/vnd.ms-excel')
        ->header("Content-Disposition", "attachment; filename=\"$filename\"");
}

public function view($id, Request $request)
{
    $report = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
        ->where('child_id', $id)
        ->where('center_id', $request->center_id)
        ->where('month', $request->report_month)
        ->firstOrFail();

    return view('reports.view_monthly_report', compact('report'));
}

//listing 

//  public function listReportsByCenter(Request $request)
//  {
//   $request->validate([
//       'center_id' => 'required|integer',
//       'class_id' => 'required|integer',
//   ]);

//   $center_id = $request->center_id;
//   $class_id = $request->class_id;

//   $reportMonths = CenterMonthReport::where('center_id', $center_id)
//       ->orderBy('report_month', 'desc')
//       ->get();

//   return view('reports.center_month_reports_listing', compact('reportMonths', 'center_id', 'class_id'));
//  }
 //,amhers & Ad,on 
 
 
 //blasde //center_inline_editor.blade.php
 public function listReportsByCenter(Request $request)
{
    $user = session('user');

    $request->validate([
        'center_id' => 'required|integer',
        'class_id' => 'required|integer',
    ]);

    $center_id = $request->center_id;
    $class_id = $request->class_id;

    // Restrict managers to their center
    if ($user['user_type'] !== 'Admin' && $user['center_id'] != $center_id) {
        return redirect()->back()->with('error', 'Access denied to this center’s reports.');
    }

    $reportMonths = CenterMonthReport::where('center_id', $center_id)
        ->orderBy('report_month', 'desc')
        ->get();

    return view('reports.center_month_reports_listing', compact('reportMonths', 'center_id', 'class_id', 'user'));
}



 //today 
 
 
 // List all center-month reports
// public function listAllReports()
// {
//     $centerReports = CenterMonthReport::with('center')
//         ->orderBy('report_month', 'desc')
//         ->get();

//     return view('reports.center_month_report_listing', compact('centerReports'));
// }

//manager & Adnibn 


public function listAllReports()
{
    $user = session('user');

    $query = CenterMonthReport::with('center')
        ->orderBy('report_month', 'desc');

    if ($user->user_type !== 'Admin') {
        $query->where('center_id', $user->center_id);
    }

    $centerReports = $query->get();

    return view('reports.center_month_report_listing', compact('centerReports'));
}



// View child monthly reports by center and month
// public function showChildReportsByMonth($center_id, $report_month)
// {
//     $children = ChildMonthlyReport::with(['child.center', 'child.class', 'child.fee'])
//         ->where('center_id', $center_id)
//         ->where('month', $report_month)
//         ->get();

//     return view('reports.view_child_reports_by_month', compact('children', 'center_id', 'report_month'));
// }


//curretly working 
// public function showChildReportsByMonth($center_id, $report_month)
// {
//     $children = ChildMonthlyReport::with(['child.center', 'child.class', 'child.fee'])
//         ->where('center_id', $center_id)
//         ->where('month', $report_month)
//         ->get();

//     $center = CenterManagements::where('center_id', $center_id)->first();
    
// //         $report_month = $report_month = $request->query('month', $report_month);
// //     $sort_by = $request->query('sort_by', 'child_id');
// //     $sort_dir = $request->query('sort_dir', 'asc');

// //     $center = CenterManagements::findOrFail($center_id);
// // $children = CenterMonthReport::with('child.class', 'child.fee')
// //     ->where('center_id', $center_id)
// //     ->where('report_month', $report_month)
// //     ->get()
// //     ->sortBy(function ($item) use ($sort_by) {
// //         $child = $item->child;

// //         if (!$child) return ''; // handle missing child safely

// //         return match($sort_by) {
// //             'child_name' => $child->child_first_name . ' ' . $child->child_last_name,
// //             'parent' => $child->parent_first_name . ' ' . $child->parent_last_name,
// //             'class' => $child->class->class_name ?? '',
// //             'fee' => $child->fee->fees_name ?? '',
// //             default => $child->child_id
// //         };
// //     }, $sort_dir === 'asc');



//     return view('reports.view_child_reports_by_month', compact('children', 'center', 'report_month'));
// }

//sorting with mow 




// public function showChildReportsByMonth(Request $request, $center_id, $report_month)
// {
//     $sort_by = $request->query('sort_by', 'child_id');
//     $sort_dir = $request->query('sort_dir', 'asc');

//     $children = ChildMonthlyReport::with(['child.center', 'child.class', 'child.fee'])
//         ->where('center_id', $center_id)
//         ->where('month', $report_month)
//         ->get();

//     // Sort manually using collection
//     $children = $children->sortBy(function ($report) use ($sort_by) {
//         $child = $report->child;

//         return match ($sort_by) {
//             'child_name' => strtolower($child->child_first_name . ' ' . $child->child_last_name),
//             'parent' => strtolower($child->parent_first_name . ' ' . $child->parent_last_name),
//             'class' => $child->class->class_name ?? '',
//             'fee' => $child->fee->fees_name ?? '',
//             default => $child->child_id ?? '',
//         };
//     });

//     if ($sort_dir === 'desc') {
//         $children = $children->reverse();
//     }

//     $center = CenterManagements::where('center_id', $center_id)->first();

//     return view('reports.view_child_reports_by_month', compact('children', 'center', 'report_month'));
// }


//after addingh filter in child reports 

public function showChildReportsByMonth(Request $request, $center_id, $report_month)
{
    $sort_by = $request->query('sort_by', 'child_id');
    $sort_dir = $request->query('sort_dir', 'asc');
    $class_id = $request->query('class_id'); // NEW FILTER

    $childrenQuery = ChildMonthlyReport::with(['child.center', 'child.class', 'child.fee'])
        ->where('center_id', $center_id)
        ->where('month', $report_month);

    // Apply class filter if selected
    if ($class_id) {
        $childrenQuery->whereHas('child.class', function ($q) use ($class_id) {
            $q->where('class_id', $class_id);
        });
    }

    $children = $childrenQuery->get();

    // Existing sorting logic
    $children = $children->sortBy(function ($report) use ($sort_by) {
        $child = $report->child;

        return match ($sort_by) {
            'child_name' => strtolower($child->child_first_name . ' ' . $child->child_last_name),
            'parent' => strtolower($child->parent_first_name . ' ' . $child->parent_last_name),
            'class' => $child->class->class_name ?? '',
            'fee' => $child->fee->fees_name ?? '',
            default => $child->child_id ?? '',
        };
    });

    if ($sort_dir === 'desc') {
        $children = $children->reverse();
    }

    $center = CenterManagements::where('center_id', $center_id)->first();

    // Get all classes of this center for dropdown
    $classes = ClassMaster::where('center_id', $center_id)->get();

    return view('reports.view_child_reports_by_month', compact('children', 'center', 'report_month', 'classes', 'class_id'));
}



//bulk updast 


// public function bulkUpdate(Request $request)
// {
//     // $request->validate([
//     //     'reports' => 'required|array',
//     //     'reports.*.id' => 'required|integer|exists:child_monthly_reports,id',
//     //     'reports.*.monthly_fee' => 'required|numeric',
//     //     'reports.*.ccfri' => 'required|numeric',
//     //     'reports.*.accb' => 'required|numeric',
//     //     'reports.*.total' => 'required|numeric',
//     //     'reports.*.fee_plan_id' => 'required|integer|exists:current_fees_masters,id',
//     // ]);

// //ewn 
// $request->validate([
//     'reports' => 'required|array',
//     'reports.*.fee_plan_id' => 'required|integer|exists:current_fees_masters,id',
//     'reports.*.monthly_fee' => 'required|numeric',
//     'reports.*.ccfri' => 'required|numeric',
//     'reports.*.accb' => 'required|numeric',
//     'reports.*.total' => 'required|numeric',
// ]);

//     // foreach ($request->reports as $reportData) {
//     //     $report = ChildMonthlyReport::find($reportData['id']);
//     foreach ($request->reports as $id => $reportData) {
//     $report = ChildMonthlyReport::findOrFail($id);
//         if ($report) {
//             $report->update([
//                 'monthly_fee' => $reportData['monthly_fee'],
//                 'ccfri' => $reportData['ccfri'],
//                 'accb' => $reportData['accb'],
//                 'total' => $reportData['monthly_fee'] - ($reportData['ccfri'] + $reportData['accb']),
//                   'fee_plan_id' => $reportData['fee_plan_id'],
//             ]);
//         }
//     }
    
//             foreach ($request->reports as $id => $reportData) {
//             $report = ReportsMaster::findOrFail($id);
        
//             // 1. Update the Report
//             $report->update([
//                 'monthly_fee' => $reportData['monthly_fee'],
//                 'ccfri' => $reportData['ccfri'],
//                 'accb' => $reportData['accb'],
//                 'total' => $reportData['total'],
//                 'fee_plan_id' => $reportData['fee_plan_id'],
//             ]);
        
//             // 2. Update the Child’s Fee Plan
//             $child = CurrentChildMaster::find($report->child_id);
//             if ($child) {
//                 $child->update([
//                     'fee_id' => $reportData['fee_plan_id'],
//                 ]);
//             }
//         }


//     return redirect()->back()->with('success', 'All reports updated successfully!');
// }


//now 

public function bulkUpdate(Request $request)
{
    $validated = $request->validate([
        'reports.*.id' => 'required|exists:child_monthly_reports,id',
        'reports.*.fee_plan_id' => 'required|exists:current_fees_masters,id',
        'reports.*.monthly_fee' => 'required|numeric',
        'reports.*.ccfri' => 'required|numeric',
        'reports.*.accb' => 'required|numeric',
        'reports.*.total' => 'required|numeric',
        'reports.*.institution_number' => 'required',
        'reports.*.transit_number' => 'required|numeric',
        'reports.*.account_number' => 'required|numeric',
    ]);

    // foreach ($request->reports as $data) {
    //     $report = ChildMonthlyReport::find($data['id']);
    //     if ($report) {
    //         $report->update([
    //             'fee_plan_id' => $data['fee_plan_id'],
    //             'monthly_fee' => $data['monthly_fee'],
    //             'ccfri' => $data['ccfri'],
    //             'accb' => $data['accb'],
    //             'total' => $data['total'],
    //         ]);

    //         // OPTIONAL: Also update the fee_plan_id in current_child_masters table
    //         $child = $report->child;
    //         if ($child) {
    //             $child->fees_id = $data['fee_plan_id'];
    //             $child->save();
    //         }
    //     }
    // }

foreach ($request->reports as $data) {
    $report = ChildMonthlyReport::find($data['id']);

    if ($report) {
        $updateData = [];

        if (isset($data['monthly_fee'])) {
            $updateData['monthly_fee'] = $data['monthly_fee'];
        }
        if (isset($data['ccfri'])) {
            $updateData['ccfri'] = $data['ccfri'];
        }
        if (isset($data['accb'])) {
            $updateData['accb'] = $data['accb'];
        }
        if (isset($data['total'])) {
            $updateData['total'] = $data['total'];
        }
          if (isset($data['institution_number'])) {
            $updateData['institution_number'] = $data['institution_number'];
        }
          if (isset($data['transit_number'])) {
            $updateData['transit_number'] = $data['transit_number'];
        }
          if (isset($data['account_number'])) {
            $updateData['account_number'] = $data['account_number'];
        }
        
 if (isset($data['notes'])) {
            $updateData['notes'] = $data['notes'];
        }

        //  Always sync latest from CurrentChildMaster
        $child = CurrentChildMaster::where('child_id', $report->child_id)->first();
        if ($child) {
            $updateData['institution_number'] = $child->institution_number;
            $updateData['transit_number']     = $child->transit_number;
            $updateData['account_number']     = $child->account_number;
        }

        $report->update($updateData);

        // Optional: update fees_id if changed
        if (isset($data['fee_plan_id'])) {
            $child = CurrentChildMaster::where('child_id', $report->child_id)->first();
            if ($child) {
                $child->fees_id = $data['fee_plan_id'];
                $child->save();
            }
        }
    }
}


    return redirect()->back()->with('success', 'Monthly reports updated successfully.');
}


// public function exportCSV(Request $request)
// {
//     $center_id = $request->query('center_id');
//     $report_month = $request->query('month');

//     // Validate presence
//     if (!$center_id || !$report_month) {
//         abort(400, 'Missing center_id or month');
//     }

//     // Fetch data
//     $children = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
//         ->where('center_id', $center_id)
//         ->where('month', $report_month)
//         ->whereHas('child', function ($q) {
//             $q->whereIn('status', [1, 2]);
//         })
//         ->get();

//     // Build CSV content
//     $csvHeader = ['Child ID', 'Child Name', 'Parent', 'Class', 'Fee Plan', 'Monthly Fee', 'CCFRI', 'ACCB', 'Total', 'Notes'];
//     $rows = [];

//     foreach ($children as $report) {
//         $rows[] = [
//             $report->child->child_id,
//             $report->child->child_first_name . ' ' . $report->child->child_last_name,
//             $report->child->parent_first_name . ' ' . $report->child->parent_last_name,
//             $report->child->class->class_name ?? 'N/A',
//             $report->child->fee->fees_name ?? 'N/A',
//             number_format($report->monthly_fee, 2),
//             number_format($report->ccfri, 2),
//             number_format($report->accb, 2),
//             number_format($report->total, 2),
//             $report->notes ?? 'N/A',
//         ];
//     }

//     // Convert to CSV
//     $handle = fopen('php://temp', 'r+');
//     fputcsv($handle, $csvHeader);

//     foreach ($rows as $row) {
//         fputcsv($handle, $row);
//     }

//     rewind($handle);
//     $csvOutput = stream_get_contents($handle);
//     fclose($handle);

//     $filename = "child_report_center_{$center_id}_{$report_month}.csv";

//     return Response::make($csvOutput, 200, [
//         'Content-Type' => 'text/csv',
//         'Content-Disposition' => "attachment; filename=\"$filename\"",
//     ]);
// }

//chnag eadmin and ,asnger 



public function exportCSV(Request $request)
{
    $user = session('user');
    $center_id = $request->query('center_id');
    $report_month = $request->query('month');

    // Handle Manager logic
    if ($user->user_type === 'Manager') {
        $center_id = $user->center_id; // Force their own center
    }

    // Validate input
    if (!$report_month || !$center_id) {
        abort(400, 'Missing center_id or month');
    }

    // Fetch children with related data
    $children = ChildMonthlyReport::with(['child', 'child.center', 'child.class', 'child.fee'])
        ->where('center_id', $center_id)
        ->where('month', $report_month)
        ->whereHas('child', function ($q) {
            $q->whereIn('status', [1, 2]);
        })
        ->get();

    // Headers: differ for Admin vs Manager
    if ($user->user_type === 'Admin') {
        $csvHeader = ['Child ID', 'Child Name', 'Parent', 'Class', 'Fee Plan', 'Monthly Fee', 'CCFRI', 'ACCB', 'Total', 'Notes','institution_number','transit_number','account_number'];
    } else {
        $csvHeader = ['Child ID', 'Child Name', 'Parent', 'Class', 'Fee Plan', 'Notes','institution_number','transit_number','account_number']; // Hide financials
    }

    $rows = [];

    foreach ($children as $report) {
        $baseRow = [
            $report->child->child_id,
            $report->child->child_first_name . ' ' . $report->child->child_last_name,
            $report->child->parent_first_name . ' ' . $report->child->parent_last_name,
            $report->child->class->class_name ?? 'N/A',
            $report->child->fee->fees_name ?? 'N/A',
        ];

        if ($user->user_type === 'Admin') {
            $baseRow[] = number_format($report->monthly_fee, 2);
            $baseRow[] = number_format($report->ccfri, 2);
            $baseRow[] = number_format($report->accb, 2);
            $baseRow[] = number_format($report->total, 2);
            $baseRow[] = $report->institution_number;
            $baseRow[] = $report->transit_number;
            $baseRow[] = $report->account_number;
        }

        $baseRow[] = $report->notes ?? 'N/A';

        $rows[] = $baseRow;
    }

    // Convert to CSV
    $handle = fopen('php://temp', 'r+');
    fputcsv($handle, $csvHeader);
    foreach ($rows as $row) {
        fputcsv($handle, $row);
    }

    rewind($handle);
    $csvOutput = stream_get_contents($handle);
    fclose($handle);

    $filename = "child_report_center_{$center_id}_{$report_month}.csv";

    return Response::make($csvOutput, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ]);
}

}
