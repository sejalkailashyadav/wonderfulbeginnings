@extends('layouts.app')

@section('content')
@php $user = session('user'); @endphp

<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="margin-top: 180px; position: relative; z-index: 5;">
        <h1 class="page-title text-primary fw-bold">
            Children Reports - {{ $center->center_name ?? 'N/A' }} | Month: {{ $report_month }}
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Children Reports</li>
        </ol>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="d-flex justify-content-end gap-2 mb-3 flex-wrap">
        <a href="{{ url('/center-month-reports/export-csv') }}?center_id={{ $center->center_id }}&month={{ $report_month }}" 
           class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export to CSV
        </a>
        <a href="{{ route('center.month.reports.list') }}" class="btn btn-secondary">
            ← Back to List
        </a>
    </div>
<!-- FILTER FORM -->
<div class="mb-3">
    <form method="GET" action="{{ route('center.month.reports.view', [$center->center_id, $report_month]) }}" class="row g-2">
        <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
        <input type="hidden" name="sort_dir" value="{{ request('sort_dir') }}">

        <div class="col-md-4">
            <select name="class_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- All Classes --</option>
                @foreach($classes as $class)
                    <option value="{{ $class->class_id }}" {{ $class_id == $class->class_id ? 'selected' : '' }}>
                        {{ $class->class_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100" style="display:none">Filter</button>
        </div>
    </form>
</div>
    @if($children->isEmpty())
        <div class="alert alert-warning text-center">No child reports found.</div>
    @else
        <div class="card shadow-sm border-0">
            <div class="card-body table-responsive">
                <table class="table table-hover table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th> ID </th>
                            <th>
                                <a href="?sort_by=child_name&sort_dir={{ request('sort_by') === 'child_name' && request('sort_dir') === 'asc' ? 'desc' : 'asc' }}">
                                    Child Name
                                    @if(request('sort_by') === 'child_name')
                                        {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="?sort_by=parent&sort_dir={{ request('sort_by') === 'parent' && request('sort_dir') === 'asc' ? 'desc' : 'asc' }}">
                                    Parent
                                    @if(request('sort_by') === 'parent')
                                        {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="?sort_by=class&sort_dir={{ request('sort_by') === 'class' && request('sort_dir') === 'asc' ? 'desc' : 'asc' }}">
                                    Class
                                    @if(request('sort_by') === 'class')
                                        {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                                    @endif
                                </a>
                            </th>
                            <th>
                                <a href="?sort_by=fee&sort_dir={{ request('sort_by') === 'fee' && request('sort_dir') === 'asc' ? 'desc' : 'asc' }}">
                                    Fee Plan
                                    @if(request('sort_by') === 'fee')
                                        {{ request('sort_dir') === 'asc' ? '▲' : '▼' }}
                                    @endif
                                </a>
                            </th>
                            @if($user->user_type === 'Admin')
                                <th>Monthly Fee</th>
                                <th>CCFRI</th>
                                <th>ACCB</th>
                                 <th>Institution Number</th>
                                  <th>Transit Number</th>
                                   <th>Account Number</th>
                                <th>Total</th>
                                 <th>Notes</th>
                            @endif
                           
                        </tr>
                    </thead>
                    <tbody>
                        @php $totalSubtotal = 0; @endphp
                        @php
    $banks = [
        'BMO' => 'BMO- 001',
        'SB'  => 'SB- 002',
        'RBC' => 'RBC - 003',
        'TD'  => 'TD- 004',
        'NBC' => 'NBC- 006',
        'CBC' => 'CBC - 010',
    ];
@endphp

                        @foreach($children as $report)
                            @php $totalSubtotal += $report->total; @endphp
                            <tr>
                                <!--<td>{{ $report->child->child_id ?? 'N/A' }}</td>-->
                                
                                
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->child->child_first_name ?? 'N/A' }} {{ $report->child->child_last_name ?? 'N/A' }}</td>
                                <td>{{ $report->child->parent_first_name ?? 'N/A' }} {{ $report->child->parent_last_name ?? 'N/A' }}</td>
                                <td>{{ $report->child->class->class_name ?? 'N/A' }}</td>
                                <td>{{ $report->child->fee->fees_name ?? 'N/A' }}</td>
                                @if($user->user_type === 'Admin')
                                    <td>${{ number_format($report->monthly_fee, 2) }}</td>
                                    <td>${{ number_format($report->ccfri, 2) }}</td>
                                    <td>${{ number_format($report->accb, 2) }}</td>
                                    <td>{{ $banks[$report->institution_number] ?? $report->institution_number }}</td>

                                     <!--<td>{{ $report->institution_number }}</td>-->
                                      <td>{{ $report->transit_number }}</td>
                                       <td>{{ $report->account_number }}</td>
                                    <td>${{ number_format($report->total, 2) }}</td>
                                    <td>{{ $report->notes ?? 'N/A' }}</td>
                                @endif
                                
                            </tr>
                        @endforeach

                        @if($user->user_type === 'Admin')
                            <tr class="fw-bold bg-light">
                                <td colspan="11" class="text-end">Subtotal:</td>
                                <td>${{ number_format($totalSubtotal, 2) }}</td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<!-- DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('table').DataTable({
            "pageLength": 10,
            "order": [],
            "columnDefs": [
                { "orderable": false, "targets": -1 } // Notes column not sortable
            ]
        });
    });
</script>
@endsection
