@extends('layouts.app')

@section('content')

<div class="container py-4">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4">
        <h1 class="page-title text-black fw-bold">Create Reports</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Reports</li>
        </ol>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('center.month.filter.submit') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Center Dropdown -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="center_id" class="form-label fw-semibold">Select Center <span class="text-danger">*</span></label>
                        <select id="center_id" name="center_id" class="form-select" required>
                            <option value="">-- Select Center --</option>
                            @foreach($centers as $center)
                                <option value="{{ $center->center_id }}">{{ $center->center_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Class Dropdown -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="class_id" class="form-label fw-semibold">Select Class</label>
                        <select id="class_id" name="class_id" class="form-select">
                            <option value="">-- Select Class --</option>
                        </select>
                    </div>

                    <!-- Month Picker -->
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label for="report_month" class="form-label fw-semibold">Select Month <span class="text-danger">*</span></label>
                        <input type="month" name="report_month" class="form-control" required>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-search me-1"></i> Show Children
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- AJAX Script to Load Classes -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#center_id').on('change', function () {
        var centerId = $(this).val();
        $('#class_id').html('<option value="">Loading...</option>');

        $.ajax({
            url: '/get-classes-by-center/' + centerId,
            method: 'GET',
            success: function (data) {
                let classSelect = $('#class_id');
                classSelect.empty().append('<option value="">Select All Class</option>');
                data.forEach(function (cls) {
                    classSelect.append('<option value="' + cls.class_id + '">' + cls.class_name + '</option>');
                });
            }
        });
    });
</script>

@endsection
