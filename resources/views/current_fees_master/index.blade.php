@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4 border-bottom pb-2 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title text-primary fw-bold mb-1">Fees Master</h1>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Center List</li>
            </ol>
        </div>
        <a href="{{ route('current-fees-master.create') }}" class="btn btn-primary shadow-sm">
            <i class="fa fa-plus me-1"></i> Add New Fees
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
            <!--filter code -->
    
        <form method="GET" action="{{ route('current-fees-master.index') }}"  id="filterForm" class="row g-2 mb-4">
            <!-- Center Dropdown -->
            <div class="col-md-4">
                <select id="center_id" name="center_id" class="form-control">
                    <option value="">-- Select Center --</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->center_id }}" 
                            {{ request('center_id') == $center->center_id ? 'selected' : '' }}>
                            {{ $center->center_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        
            <!-- Class Dropdown -->
            <div class="col-md-4">
                <select id="class_id" name="class_id" class="form-control">
                    <option value="">-- Select Class --</option>
                </select>
            </div>
        
            <!-- Submit Button -->
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                 <button type="button"  class="btn btn-primary" id="resetBtns">
                         Reset
                        </button>
            </div>
            
        </form>

    <!-- Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 70vh; overflow-y: auto;">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table" style="position: sticky; top: 0; z-index: 5;">
                        <tr class="text-center fw-bold">
                            <th>#</th>
                            <th>Center</th>
                             <th>Class</th>
                            <th>Fees Name</th>
                            <th>Monthly Fees</th>
                            <th>CCFRI</th>
                            <th>Total</th>
                           
                            <th style="width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fees as $fee)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $fee->center->center_name ?? 'N/A' }}</td>
                                <td>{{ $fee->class->class_name ?? 'N/A' }}</td>
                                <td>{{ $fee->fees_name }}</td>
                                <td class="text-end">${{ number_format($fee->monthly_fees, 2) }}</td>
                                <td class="text-end">${{ number_format($fee->ccfri, 2) }}</td>
                                <td class="text-end">${{ number_format($fee->total, 2) }}</td>
                                
                                <td class="text-center">
                                    <a href="{{ route('current-fees-master.edit', $fee->id) }}" 
                                       class="btn btn-sm btn-outline-primary me-1" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('current-fees-master.destroy', $fee->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Delete this fee?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-3">
                                    <i class="fa fa-info-circle me-2"></i> No fees records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$('#center_id').on('change', function () {
    var centerId = $(this).val();
    $('#class_id').html('<option value="">Loading...</option>');

    if(centerId) {
        $.ajax({
            url: '/get-classes-by-center/' + centerId,
            method: 'GET',
            success: function (data) {
                let classSelect = $('#class_id');
                classSelect.empty().append('<option value="">-- Select Class --</option>');
                data.forEach(function (cls) {
                    classSelect.append('<option value="' + cls.class_id + '">' + cls.class_name + '</option>');
                });
            }
        });
    } else {
        $('#class_id').html('<option value="">-- Select Class --</option>');
    }
});

  document.getElementById('resetBtns').addEventListener('click', function () {
        document.getElementById('filterForm').reset();
        window.location.href = "{{ route('current-fees-master.index') }}";
        
    });
</script>

@endsection
