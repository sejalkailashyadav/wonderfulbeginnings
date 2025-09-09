
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Saved Center-Month Reports</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Report ID</th>
                <th>Center ID</th>
                <th>Report Month</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->center_id }}</td>
                <td>{{ $report->report_month }}</td>
                <td>{{ $report->created_at }}</td>
                <td>
                    <a href="{{ route('reports.view', [$report->center_id, $report->report_month]) }}" class="btn btn-sm btn-info">
                        View
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection