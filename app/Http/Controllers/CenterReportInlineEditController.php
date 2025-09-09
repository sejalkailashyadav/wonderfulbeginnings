<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CenterManagements;
use App\Models\ChildMonthlyReport;

class CenterReportInlineEditController extends Controller
{
    public function index(Request $request)
    {
        $centers = CenterManagements::all();
        $selectedCenterId = $request->get('center_id');
        $selectedMonth = $request->get('month');

        $reports = [];

        if ($selectedCenterId && $selectedMonth) {
            $reports = ChildMonthlyReport::with(['child.center', 'child.class', 'child.fee'])
                ->where('center_id', $selectedCenterId)
                ->where('month', $selectedMonth)
                ->get();
        }

        return view('reports.center_inline_editor', compact('centers', 'reports', 'selectedCenterId', 'selectedMonth'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'reports' => 'required|array',
        ]);

        // foreach ($request->reports as $id => $data) {
        //     $report = ChildMonthlyReport::find($id);
        //     if ($report) {
        //         $monthly_fee = floatval($data['monthly_fee']);
        //         $ccfri = floatval($data['ccfri']);
        //         $accb = floatval($data['accb']);

        //         $report->monthly_fee = $monthly_fee;
        //         $report->ccfri = $ccfri;
        //         $report->accb = $accb;
        //         $notes = isset($data['notes']) ? $data['notes'] : null;
        //         $report->total = $monthly_fee - ($ccfri + $accb);
        //         $report->save();
        //     }
        // }
        foreach ($request->reports as $id => $data) {
            $report = ChildMonthlyReport::find($id);
            if ($report) {
                $monthly_fee = floatval($data['monthly_fee']);
                $ccfri = floatval($data['ccfri']);
                $accb = floatval($data['accb']);
                $notes = $data['notes'] ?? null;
                $institution_number= $data['institution_number'] ?? null;
                $transit_number = $data['transit_number'] ?? null;
                $account_number = $data['account_number'] ?? null;
        
                $report->monthly_fee = $monthly_fee;
                $report->ccfri = $ccfri;
                $report->accb = $accb;
                $report->notes = $notes;
                $report->institution_number = $institution_number;
                $report->transit_number= $transit_number;
                $report->account_number = $account_number;
                $report->total = $monthly_fee - ($ccfri + $accb);
                
                $report->save();
            }
        }

        return redirect()->route('center.report.editor', [
            'center_id' => $request->get('center_id'),
            'month' => $request->get('month')
        ])->with('success', 'Reports updated successfully.');
    }
}
