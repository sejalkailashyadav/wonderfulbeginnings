@extends('layouts.app')

 @section('content')
 <h4>Available Monthly Reports</h4>

 <a href="{{ route('center.month.filter') }}" class="btn btn-secondary">← Back</a>

 <table class="table table-bordered mt-3">
   <thead>
       <tr>
           <th>Center</th>
           <th>Month</th>
           <th>Action</th>
       </tr>
   </thead>
   <tbody>
       @foreach($reportMonths as $report)
           <tr>
               <td>{{ $report->center->center_name ?? 'N/A' }}</td>
               <td>{{ $report->report_month }}</td>
               <td>
                   <form action="{{ route('center.month.filter.submit') }}" method="POST">
                       @csrf
                       <input type="hidden" name="center_id" value="{{ $center_id }}">
                       <input type="hidden" name="class_id" value="{{ $class_id }}">
                       <input type="hidden" name="report_month" value="{{ $report->report_month }}">
                       <button type="submit" class="btn btn-primary btn-sm">View Reports</button>
                   </form>
               </td>
           </tr>
       @endforeach
   </tbody>
 </table>
 @endsection