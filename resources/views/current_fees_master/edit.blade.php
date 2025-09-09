@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4 border-bottom pb-2">
        <h1 class="page-title text-primary fw-bold mb-0">Edit Fees Record</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('current-fees-master.index') }}">Fees Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Fees</li>
        </ol>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold"><i class="fa fa-edit me-2"></i> Fees Information</h5>
                </div>
                <div class="card-body">

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Whoops!</strong> Please fix the following errors:
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Edit Form -->
                    <form method="POST" action="{{ route('current-fees-master.update', $fees->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">

                            <!-- Center -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Center <span class="text-danger">*</span></label>
                                <select name="center_id" id="center_id" class="form-select" required>
                                    <option value="">Select Center</option>
                                    @foreach($centers as $center)
                                        <option value="{{ $center->center_id }}" {{ $fees->center_id == $center->center_id ? 'selected' : '' }}>
                                            {{ $center->center_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Class -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Class</label>
                                <select name="class_id" id="class_id" class="form-select">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->class_id }}" {{ $fees->class_id == $class->class_id ? 'selected' : '' }}>
                                            {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Fees Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Fees Name</label>
                                <input type="text" name="fees_name" class="form-control @error('fees_name') is-invalid @enderror" value="{{ $fees->fees_name }}">
                                @error('fees_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Monthly Fees -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">Monthly Fees</label>
                                <input type="number" step="0.01" name="monthly_fees" class="form-control @error('monthly_fees') is-invalid @enderror" value="{{ $fees->monthly_fees }}">
                                @error('monthly_fees')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- CCFRI -->
                            <div class="col-md-3">
                                <label class="form-label fw-bold">CCFRI</label>
                                <input type="number" step="0.01" name="ccfri" class="form-control @error('ccfri') is-invalid @enderror" value="{{ $fees->ccfri }}">
                                @error('ccfri')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('current-fees-master.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="fa fa-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Update
                            </button>
                        </div>

                    </form>
                    <!-- End Form -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dynamic Dropdown Script -->
<script>
document.getElementById('center_id').addEventListener('change', function () {
    let centerId = this.value;
    fetch(`/get-classes-by-center/${centerId}`)
        .then(response => response.json())
        .then(data => {
            let classDropdown = document.getElementById('class_id');
            classDropdown.innerHTML = '<option value="">Select Class</option>';
            data.forEach(function (cls) {
                let option = document.createElement('option');
                option.value = cls.class_id;
                option.textContent = cls.class_name;
                classDropdown.appendChild(option);
            });
        });
});
</script>
@endsection
