@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
         style="margin-top: 150px; z-index: 5; position: relative;">
        <h1 class="h3 text-black fw-bold mb-0">Add to Manager List</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Manager List Entry</li>
        </ol>
    </div>

    <!-- FORM CARD -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold">Manager List Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('Manager-lists.store') }}">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                            <label for="user_name" class="form-label">User Name <span class="text-danger">*</span></label>
                            <input type="text" name="user_name" class="form-control" placeholder="Enter user name" required>
                            </div>
                             <div class="col-md-6">
                                <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                <textarea name="password" class="form-control" rows="2" required>{{ old('password') }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Preferred Location <span class="text-danger">*</span></label>
                                <select id="center_id" name="preferred_location" class="form-select">
                                    <option value="">Select Center</option>
                                    @foreach($centers as $center)
                                        <option value="{{ $center->center_id }}" {{ old('preferred_location') == $center->center_id ? 'selected' : '' }}>
                                            {{ $center->center_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const centerDropdown = document.getElementById('center_id');
    centerDropdown.addEventListener('change', function () {
        const centerId = this.value;
        if (centerId) {
            fetch(`/get-classes-by-center/${centerId}`)
                .then(res => res.json())
                .catch(err => console.error('Error fetching classes:', err));
        }
    });
});
</script>
@endsection
