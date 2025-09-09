<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CenterReportController extends Controller
{

    //update code
    public function index(Request $request)
    {
        $month = $request->get('month') ?? date('m');
        $year = $request->get('year') ?? date('Y');
        $selectedCenter = $request->get('center_name') ?? '';
        $selectedProgram = $request->get('program_name') ?? '';
        // dd($month, $year,$selectedCenter,$selectedProgram);
        $query = DB::table('child_masters as c')
            ->join('center_managments as cm', 'c.center_id', '=', 'cm.center_id')
            ->join('program_masters as pm', 'c.program_id', '=', 'pm.program_id')
            ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
            ->select(
                'cm.center_name',
                'pc.program_name',
                DB::raw('COUNT(c.child_id) as total_kids'),
                DB::raw("SUM(CASE WHEN MONTH(c.admission_date) = $month AND YEAR(c.admission_date) = $year THEN 1 ELSE 0 END) as new"),
                DB::raw("SUM(CASE WHEN MONTH(c.end_date) = $month AND YEAR(c.end_date) = $year THEN 1 ELSE 0 END) as leftout")
            )
            ->when($selectedCenter, fn($q) => $q->where('cm.center_name', $selectedCenter))
            ->when($selectedProgram, fn($q) => $q->where('pc.program_name', $selectedProgram))
            ->groupBy('cm.center_name', 'pc.program_name')
            ->orderBy('cm.center_name')
            ->orderBy('pc.program_name');

        $data = $query->get();

        $centers = DB::table('center_managments')->pluck('center_name');
        $programs = DB::table('program_creates')->pluck('program_name');

        return view('reports.center_report', compact(
            'data',
            'centers',
            'programs',
            'month',
            'year',
            'selectedCenter',
            'selectedProgram'
        ));

    }
    ///for details 

    public function details(Request $request)
    {
        $center = $request->get('center');
        $program = $request->get('program');
        // $month = $request->get('month');
        // $year = $request->get('year');
        // dd($request);
        $children = DB::table('child_masters as c')
            ->join('center_managments as cm', 'c.center_id', '=', 'cm.center_id')
            ->join('program_masters as pm', 'c.program_id', '=', 'pm.program_id')
            ->join('program_creates as pc', 'pm.prog_master_id', '=', 'pc.prog_master_id')
            ->select(
                'c.child_id',
                'c.child_first_name',
                'c.child_last_name',
                'c.parent_first_name',
                'c.parent_last_name',
                'c.child_dob',
                'c.transit_number',
                'c.admission_date',
                'c.active_status',
                'c.institution_number',
                'c.end_date',
                'c.number_of_days',
                'cm.center_name',
                'pc.program_name'
            )
            ->where('cm.center_name', $center)
            ->where('pc.program_name', $program)
            // ->whereMonth('c.admission_date', $month)
            // ->whereYear('c.admission_date', $year)
            ->get();


        return view('reports.child_details', compact('children', 'center', 'program'));
    }


}
