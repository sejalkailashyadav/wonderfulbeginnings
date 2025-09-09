@extends('layouts.app')

@section('content')
<style>
    /* Fix for fixed navbar overlapping content */
    body {
        padding-top: 70px; /* Adjust if navbar height changes */
    }
</style>

<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header mb-4">
        <h1 class="page-title">Edit Center Management</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('center-managements') }}">Centers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Center</li>
        </ol>
    </div>

    <!-- FORM CARD -->
    <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
            <div class="card custom-card shadow-sm">
                <div class="card-header text-primary">
                    <h3 class="card-title mb-0">Edit Center Information</h3>
                </div>
                <div class="card-body">
                    
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

                    <form action="{{ url('center-managements/' . $center->center_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <!-- Center Details -->
                            <div class="col-md-6">
                                <label for="center_name" class="form-label">Center Name <span class="text-danger">*</span></label>
                                <input type="text" name="center_name" class="form-control" value="{{ $center->center_name }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="center_address" class="form-label">Center Address <span class="text-danger">*</span></label>
                                <input type="text" name="center_address" class="form-control" value="{{ $center->center_address }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="center_email" class="form-label">Center Email <span class="text-danger">*</span></label>
                                <input type="email" name="center_email" class="form-control" value="{{ $center->center_email }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" value="{{ $center->phone_number }}">
                            </div>

                            <!-- Licensing Details -->
                            <div class="col-md-6">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" name="license_number" class="form-control" value="{{ $center->license_number }}">
                            </div>

                            <div class="col-md-6">
                                <label for="g_number" class="form-label">G Number</label>
                                <input type="text" name="g_number" class="form-control" value="{{ $center->g_number }}">
                            </div>

                            <div class="col-md-6">
                                <label for="facility_number" class="form-label">Facility Number</label>
                                <input type="text" name="facility_number" class="form-control" value="{{ $center->facility_number }}">
                            </div>

                            <div class="col-md-6">
                                <label for="licensing_officer_name" class="form-label">Licensing Officer Name</label>
                                <input type="text" name="licensing_officer_name" class="form-control" value="{{ $center->licensing_officer_name }}">
                            </div>

                            <div class="col-md-6">
                                <label for="licensing_officer_email" class="form-label">Licensing Officer Email</label>
                                <input type="email" name="licensing_officer_email" class="form-control" value="{{ $center->licensing_officer_email }}">
                            </div>

                            <div class="col-md-6">
                                <label for="licensing_officer_mobile" class="form-label">Licensing Officer Mobile</label>
                                <input type="text" name="licensing_officer_mobile" class="form-control" value="{{ $center->licensing_officer_mobile }}">
                            </div>

                            <!-- Documents Upload -->
                            <div class="col-md-4">
                                <label for="business_license_doc" class="form-label">Business License Doc</label>
                                @if($center->business_license_doc)
                                    <div class="mb-1">
                                        <a href="{{ asset($center->business_license_doc) }}" target="_blank" class="btn btn-link p-0">View Document</a>
                                    </div>
                                @endif
                                <input type="file" name="business_license_doc" class="form-control">
                            </div>
                            
                            <div class="col-md-4">
                                <label for="facility_license_doc" class="form-label">Facility License Doc</label>
                                @if($center->facility_license_doc)
                                    <div class="mb-1">
                                        <a href="{{ asset($center->facility_license_doc) }}" target="_blank" class="btn btn-link p-0">View Document</a>
                                    </div>
                                @endif
                                <input type="file" name="facility_license_doc" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label for="incorporation_doc" class="form-label">Incorporation Document</label>
                                @if($center->incorporation_doc)
                                    <div class="mb-1">
                                        <a href="{{ asset($center->incorporation_doc) }}" target="_blank" class="btn btn-link p-0">View Document</a>
                                    </div>
                                @endif
                                <input type="file" name="incorporation_doc" class="form-control">
                            </div>
                            
                               <!-- Number of Classrooms -->
                            <div class="col-md-6 mb-3">
                                <label for="number_of_classrooms" class="form-label">Number of Classrooms <span class="text-danger">*</span></label>
                                <input type="number" name="number_of_classrooms" class="form-control"
                                       value="{{ $center->number_of_classrooms }}" placeholder="Enter number of classrooms">
                            </div>
                            
                               <!-- CCOF Document -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">CCOF Document</label>
                                 @if($center->ccof)
                                    <div class="mb-1">
                                        <a href="{{ asset($center->ccof) }}" target="_blank" class="btn btn-link p-0">View Document</a>
                                    </div>
                                @endif
                                
                                <input type="file" name="ccof" class="form-control">
                            </div>
                            
                            <!--Inspection Reports -->
                             <div class="col-md-4 mb-3">
                                <label class="form-label">Inspection Reports</label>
                                 @if($center->inspection_reports)
                                    <div class="mb-1">
                                        <a href="{{ asset($center->inspection_reports) }}" target="_blank" class="btn btn-link p-0">View Document</a>
                                    </div>
                                @endif
                                <input type="file" name="inspection_reports" class="form-control">
                            </div>
                            

                            <!-- Gallery Button -->
                            <div class="col-md-12">
                                <a href="{{ route('center_managements.gallery', $center->center_id) }}" class="btn btn-outline-primary w-100">View Gallery</a>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">Update Center</button>
                            <a href="{{ url('center-managements') }}" class="btn btn-secondary">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- FORM CARD END -->

</div>
@endsection
