@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
         style=" z-index: 5; position: relative;">
        <h1 class="h3 text-black fw-bold mb-0">Edit Class Management</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Center</li>
        </ol>
    </div>

    <!-- FORM CARD -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header">
                    <h5 class="mb-0 fw-bold"> Class Information</h5>
                </div>
                <div class="card-body">

                    <!-- Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ url('class-masters/' . $class->class_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            <!-- Class Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Class Name <span class="text-danger">*</span></label>
                                <input type="text" name="class_name" class="form-control" value="{{ $class->class_name }}" required>
                            </div>

                            <!-- Amount of Children -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Amount of Children <span class="text-danger">*</span></label>
                                <input type="number" name="amount_of_children" value="{{ $class->amount_of_children }}" class="form-control" required>
                            </div>

                            <!-- Current Schedule -->
                            @if($class->classroom_schedules)
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Current Schedule</label>
                                    <div>
                                        <a href="{{ asset($class->classroom_schedules) }}" target="_blank" class="text-decoration-none">
                                            <i class="fa fa-file-pdf me-1 text-danger"></i> View Current Schedule
                                        </a>
                                    </div>
                                </div>
                            @endif

                            <!-- Upload Schedule -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Upload Classroom Schedules (PDF)</label>
                                <input type="file" name="classroom_schedules" class="form-control">
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ url('class-masters') }}" class="btn btn-secondary me-2">
                                <i class="fa fa-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i> Update Center
                            </button>
                        </div>

                    </form>
                    <!-- End Form -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
