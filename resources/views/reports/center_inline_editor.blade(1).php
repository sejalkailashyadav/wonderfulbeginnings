@extends('layouts.app')

@section('content')
<div class="container">
        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Monthly Report for Admin</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
             
            </ol>
        </div>


    <form method="GET" action="{{ route('center.report.editor') }}" class="mb-4" id="filterForm">
        <div class="row">
            <div class="col-md-4">
                <label for="center_id">Select Center:</label>
                <select name="center_id" class="form-control" required>
                    <option value="">-- Select --</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->center_id }}" {{ ($center->center_id == $selectedCenterId) ? 'selected' : '' }}>
                            {{ $center->center_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="month">Month:</label>
                <input type="month" name="month" class="form-control" value="{{ $selectedMonth }}" required>
            </div>
            <div class="col-md-4 mt-4">
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
                 <button type="button" class="btn btn-secondary" id="resetBtns">Reset</button>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($reports) > 0)
    <form method="POST" action="{{ route('center.report.editor.update') }}">
        @csrf
        <input type="hidden" name="center_id" value="{{ $selectedCenterId }}">
        <input type="hidden" name="month" value="{{ $selectedMonth }}">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Child ID</th>
                    <th>Name</th>
                    <th>Parent</th>
                    <th>Class</th>
                    <th>Fee Plan</th>
                    <th>Monthly Fee</th>
                    <th>CCFRI</th>
                    <th>ACCB</th>
                    <th>Total</th>
                    <th>Notes</th> 
                </tr>
            </thead>
            <tbody>
                     @foreach($reports as $report)
                    <tr>
                        <td>{{ $report->child->child_id }}</td>
                        <td>{{ $report->child->child_first_name }} {{ $report->child->child_last_name }}</td>
                        <td>{{ $report->child->parent_first_name }} {{ $report->child->parent_last_name }}</td>
                        <td>{{ $report->child->class->class_name ?? 'N/A' }}</td>
                        <td>{{ $report->child->fee->fees_name ?? 'N/A' }}</td>
                        <td><input type="number" step="0.01" name="reports[{{ $report->id }}][monthly_fee]" value="{{ $report->monthly_fee }}" class="form-control"></td>
                        <td><input type="number" step="0.01" name="reports[{{ $report->id }}][ccfri]" value="{{ $report->ccfri }}" class="form-control"></td>
                        <td><input type="number" step="0.01" name="reports[{{ $report->id }}][accb]" value="{{ $report->accb ?? 0 }}" class="form-control"></td>
                        <td>${{ number_format($report->monthly_fee - ($report->ccfri + ($report->accb ?? 0)), 2) }}</td>
                        <td>
                            <input type="text" name="reports[{{ $report->id }}][notes]" value="{{ $report->notes }}" class="form-control">
                        </td>

                   
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-success">Save All</button>
        <br>
    </form>
    <br>  <br>
    @elseif($selectedCenterId && $selectedMonth)
        <p class="text-danger mt-4">No reports found for selected center and month.</p>
    @endif
</div>
<script>
    document.getElementById('resetBtns').addEventListener('click', function () {
        const form = document.getElementById('filterForm');

        // Reset form values to default
        form.reset();

        // Redirect to the base URL without query parameters
        window.location.href = "{{ route('center.report.editor') }}";
    });
        $(document).ready(function () {
        $('table.table').DataTable({
            "order": [[0, 'asc']], // Default sort by Child ID
            "columnDefs": [
                { "orderable": true, "targets": [0,1,2,3] }, // Enable sorting for first 4 cols
                { "orderable": false, "targets": '_all' } // Disable for rest
            ]
        });

        // Reset button
        document.getElementById('resetBtn').addEventListener('click', function () {
            const form = document.getElementById('filterForm');
            form.reset();
            window.location.href = "{{ route('center.report.editor') }}";
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

@endsection
