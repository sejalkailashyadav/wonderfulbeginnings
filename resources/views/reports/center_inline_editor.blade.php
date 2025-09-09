@extends('layouts.app')

@section('content')
<style>
<style>
/* Base styling for all editable inputs */
.table td input,
.table td textarea {
    width: 100%;
    box-sizing: border-box;
}

/* Monthly Fee */
.table td input[name*="[monthly_fee]"] {
    min-width: 110px;
}

/* CCFRI */
.table td input[name*="[ccfri]"] {
    min-width: 100px;
}

/* ACCB */
.table td input[name*="[accb]"] {
    min-width: 110px;
}

/* Institution Number */
.table td input[name*="[institution_number]"] {
    min-width: 600px;
}

/* Transit Number */
.table td input[name*="[transit_number]"] {
    min-width: 80px;
}

/* Account Number */
.table td input[name*="[account_number]"] {
    min-width: 117px;
}

/* Notes field wider */
.table td input[name*="[notes]"],
.table td textarea[name*="[notes]"] {
    min-width: 300px;
}
</style>


</style>
<div class="container py-4">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4">
        <h1 class="page-title text-primary fw-bold">Monthly Report for Admin</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monthly Report</li>
        </ol>
    </div>

    <!-- FILTER FORM -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('center.report.editor') }}" id="filterForm">
                <div class="row align-items-end">
                    
                    <!-- Select Center -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="center_id" class="form-label fw-semibold">Select Center <span class="text-danger">*</span></label>
                        <select name="center_id" class="form-select" required>
                            <option value="">-- Select --</option>
                            @foreach($centers as $center)
                                <option value="{{ $center->center_id }}" {{ ($center->center_id == $selectedCenterId) ? 'selected' : '' }}>
                                    {{ $center->center_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Month -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="month" class="form-label fw-semibold">Select Month <span class="text-danger">*</span></label>
                        <input type="month" name="month" class="form-control" value="{{ $selectedMonth }}" required>
                    </div>

                    <!-- Buttons -->
                    <div class="col-lg-4 col-md-12 mb-3 text-md-start text-lg-end">
                        <button type="submit" class="btn btn-primary px-4 me-2">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <button type="button" class="btn btn-secondary px-4 me-2" id="resetBtns">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SUCCESS ALERT -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- REPORT TABLE -->
    @if(count($reports) > 0)
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="POST" action="{{ route('center.report.editor.update') }}">
                @csrf
                <input type="hidden" name="center_id" value="{{ $selectedCenterId }}">
                <input type="hidden" name="month" value="{{ $selectedMonth }}">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Child ID</th>
                                <th>Name</th>
                                <th>Parent</th>
                                <th>Class</th>
                                <th>Fee Plan</th>
                                <th>Monthly Fee</th>
                                <th>CCFRI</th>
                                <th>ACCB</th>
                                 <th>Institution Number</th>
                                  <th>Transit Number</th>
                                   <th>Account Numberr</th>
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
                                <td>
                                    <input type="number" step="0.01" name="reports[{{ $report->id }}][monthly_fee]" value="{{ $report->monthly_fee }}" class="form-control">
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="reports[{{ $report->id }}][ccfri]" value="{{ $report->ccfri }}" class="form-control">
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="reports[{{ $report->id }}][accb]" value="{{ $report->accb ?? 0 }}" class="form-control">
                                </td>
                                <!-- <td>-->
                                <!--    <input type="text" step="0.01" name="reports[{{ $report->id }}][institution_number]" value="{{ $report->institution_number ?? 0 }}" class="form-control" readonly="">-->
                                <!--</td>-->
                                <!-- <td>-->
                                <!--    <input type="number" step="0.01" name="reports[{{ $report->id }}][transit_number]" value="{{ $report->transit_number ?? 0 }}" class="form-control" readonly="">-->
                                <!--</td>-->
                                <!-- <td>-->
                                <!--    <input type="number" step="0.01" name="reports[{{ $report->id }}][account_number]" value="{{ $report->account_number ?? 0 }}" class="form-control" readonly="">-->
                                </td>
                               <td>{{ $report->institution_number?? 'N/A' }}</td>
                               <td>{{ $report->transit_number?? 'N/A' }}</td>
                               <td>{{ $report->account_number?? 'N/A' }}</td>
                                <td>${{ number_format($report->monthly_fee - ($report->ccfri + ($report->accb ?? 0)), 2) }}</td>
                                <td>
                                    <input type="text" name="reports[{{ $report->id }}][notes]" value="{{ $report->notes }}" class="form-control">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Save Button -->
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Save All
                    </button>
                </div>
            </form>
        </div>
    </div>
    <br><br>

    @elseif($selectedCenterId && $selectedMonth)
        <p class="text-danger mt-4">No reports found for selected center and month.</p>
    @endif
</div>

<!-- SCRIPTS -->
<script>
    document.getElementById('resetBtns').addEventListener('click', function () {
        document.getElementById('filterForm').reset();
        window.location.href = "{{ route('center.report.editor') }}";
    });

    $(document).ready(function () {
        $('table.table').DataTable({
            "order": [[0, 'asc']],
            "columnDefs": [
                { "orderable": true, "targets": [0,1,2,3] },
                { "orderable": false, "targets": '_all' }
            ]
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endsection
