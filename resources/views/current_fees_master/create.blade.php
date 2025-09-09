@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Create New Fees</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card custom-card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0">Fees Information</h3>
                </div>
                <div class="card-body">

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form method="POST" action="{{ route('current-fees-master.store') }}">
                        @csrf

                        <div class="row g-4">
                            <!-- Center Dropdown -->
                            <div class="col-md-6">
                                <label class="form-label">Center Name <span class="text-danger">*</span></label>
                                <select name="center_id" id="center_id" class="form-select" required>
                                    <option value="">Select Center</option>
                                    @foreach($centers as $center)
                                        <option value="{{ $center->center_id }}">{{ $center->center_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Class Dropdown -->
                            <div class="col-md-6">
                                <label class="form-label">Class Name <span class="text-danger">*</span></label>
                                <select name="class_id" id="class_id" class="form-select" required>
                                    <option value="">Select Class</option>
                                </select>
                            </div>

                            <!-- Fees Name -->
                            <div class="col-md-6">
                                <label class="form-label">Fees Name</label>
                                <input type="text" name="fees_name" class="form-control" placeholder="Enter Fees Name">
                                @error('fees_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Monthly Fees -->
                            <div class="col-md-6">
                                <label class="form-label">Monthly Fees</label>
                                <input type="number" name="monthly_fees" class="form-control" step="0.01" placeholder="Enter Monthly Fees">
                                @error('monthly_fees')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- CCFRI -->
                            <div class="col-md-6">
                                <label class="form-label">CCFRI</label>
                                <input type="number" name="ccfri" class="form-control" step="0.01" placeholder="Enter CCFRI">
                                @error('ccfri')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success px-4">Save</button>
                            <a href="{{ route('current-fees-master.index') }}" class="btn btn-secondary px-4">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Class Dropdown -->
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
