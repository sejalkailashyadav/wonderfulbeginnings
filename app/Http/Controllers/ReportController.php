<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ReportController extends Controller
{
    // Show all monthly reports
    public function index()
    {

        //get data with center name
        $reports = DB::table('monthly_report_logs')
            ->join('center_managments', 'monthly_report_logs.center_id', '=', 'center_managments.center_id')
            ->select('monthly_report_logs.*', 'center_managments.center_name')
            ->get();

        return view('reports.index', compact('reports'));
    }

    // Show logs for selected monthly report
    // public function show($id)
    // {
    //     $logs = DB::table('all_report_logs')
    //         ->where('month_report_id', $id)
    //         ->get();

        
    //     return view('reports.show', compact('logs', 'id'));
    // }

    
public function show($id)
{
    $logs = DB::table('all_report_logs')
        ->where('month_report_id', $id)
        ->get();

    // Get center_id, month_year, and report_name from monthly_report_logs
//  $reportInfo = DB::table('monthly_report_logs')
//         ->where('month_report_id', $id)
//         ->select('center_id', 'month_year', 'report_name')
//         ->first(); 

        $reportInfo = DB::table('monthly_report_logs as mr')
    ->join('center_managments as cm', 'mr.center_id', '=', 'cm.center_id')
    ->where('mr.month_report_id', $id)
    ->select('mr.center_id', 'cm.center_name', 'mr.month_year', 'mr.report_name')
    ->first();

    return view('reports.show', compact('logs', 'id', 'reportInfo'));
}

    // //edit all logs reports

    // public function edit($id)
    // {
    //     $log = DB::table('all_report_logs')->where('report_log_id', $id)->first();
    //     return view('reports.edit', compact('log'));
    // }

    // //save all logs reports by id 
    // public function update(Request $request, $id)
    // {
    //     DB::table('all_report_logs')->where('report_log_id', $id)->update([
    //         'child_name' => $request->child_name,
    //         'parent_name' => $request->parent_name,
    //         'number_of_days' => $request->number_of_days,
    //         'total_fees' => $request->total_fees,
    //         'ccfri' => $request->ccfri,
    //         'accb' => $request->accb,
    //         'received_parent_fees' => $request->total_fees - ($request->ccfri + $request->accb),
    //         'date_of_birth' => $request->date_of_birth,
    //     ]);

    //     return redirect()->back()->with('success', 'Report updated successfully.');
    // }


//added thsi new fress collestion chnaeg edut and uudoat efucniton


public function edit($id)
{
    $report = ChildMonthlyReport::with('child')->findOrFail($id);
    return view('reports.edit_monthly_report', compact('report'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'monthly_fee' => 'required|numeric',
        'ccfri' => 'required|numeric',
        'total' => 'required|numeric',
    ]);

    $report = ChildMonthlyReport::findOrFail($id);
    $report->update([
        'monthly_fee' => $request->monthly_fee,
        'ccfri' => $request->ccfri,
        'total' => $request->total,
    ]);

    return redirect()->back()->with('success', 'Monthly report updated successfully.');
}





    //delete all logs reports by id 
    public function destroy($id)
    {
        DB::table('all_report_logs')->where('report_log_id', $id)->delete();
        return redirect()->back()->with('success', 'Report deleted successfully.');
    }

    //edit accb 
    public function updateAccb(Request $request, $id)
    {
        $validated = $request->validate([
            'accb' => 'required|numeric',
        ]);


        DB::table('all_report_logs')->where('report_log_id', $id)->update([
            'accb' => $request->accb,

        ]);

        return response()->json(['success' => true, 'message' => 'ACCB value updated successfully.']);
    }

}