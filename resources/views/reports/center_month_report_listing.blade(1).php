
@extends('layouts.app')

@section('content')
  <!-- PAGE HEADER -->
      <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">Center Monthly Report Listings</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
         
            </ol>
        </div>
        


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
                    <a href="{{ route('center.month.reports.view', [$report->center_id, $report->report_month]) }}" class="btn btn-sm btn-primary">
                        View
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection