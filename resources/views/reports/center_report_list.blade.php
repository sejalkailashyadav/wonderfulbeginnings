    
 @extends('layouts.app')

 @section('content')
 <div class="container">
     <h2>Center Monthly Reports</h2>

     <table class="table table-bordered">
         <thead>
             <tr>
                 <th>Center Name</th>
                 <th>Report Month</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             @foreach($centerReports as $report)
                 <tr>
                     <td>{{ $report->center->center_name ?? 'N/A' }}</td>
                     <td>{{ $report->report_month }}</td>
                     <td>
                         <a href="{{ route('monthly-report.children.view', [
                             'center_id' => $report->center_id,
                             'report_month' => $report->report_month
                         ]) }}" class="btn btn-info">View Children</a>
                     </td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </div>
 @endsection
