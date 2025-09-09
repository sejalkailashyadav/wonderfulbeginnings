@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4">
        <h1 class="page-title text-primary fw-bold">Center Monthly Report Listings</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monthly Reports</li>
        </ol>
    </div>

    <!-- REPORTS TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($centerReports->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Center Name</th>
                                <th>Report Month</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($centerReports as $report)
                                <tr>
                                    <td>{{ $report->center->center_name ?? 'N/A' }}</td>
                                    <td>{{ $report->report_month }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('center.month.reports.view', [$report->center_id, $report->report_month]) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning text-center mb-0">
                    No monthly reports found.
                </div>
            @endif
        </div>
    </div>

</div>

<!-- Optional: DataTables for Search, Sort & Pagination -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('table').DataTable({
            "pageLength": 10,
            "order": [[0, "asc"]],
            "columnDefs": [
                { "orderable": false, "targets": 2 }
            ]
        });
    });
</script>
@endsection
