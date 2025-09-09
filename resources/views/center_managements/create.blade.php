@extends('layouts.app')

<style>
    /* Adjust this based on your navbar height */
body {
    padding-top: 70px; /* 70px works for most Bootstrap navbars */
}
</style>
@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">Create Center</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Center</li>
        </ol>
    </div>
    <!-- PAGE HEADER END -->

    <!-- FORM CARD -->
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-header text-primary">
                    <h3 class="card-title mb-0">Center Information</h3>
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

                    <form action="{{ url('center-managements') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <!-- Center Name -->
                            <div class="col-md-6 mb-3">
                                <label for="center_name" class="form-label">Center Name <span class="text-danger">*</span></label>
                                <input type="text" name="center_name" class="form-control" 
                                       value="{{ old('center_name') }}" placeholder="Enter center name">
                                @error('center_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Center Address -->
                            <div class="col-md-6 mb-3">
                                <label for="center_address" class="form-label">Center Address <span class="text-danger">*</span></label>
                                <input type="text" name="center_address" class="form-control"
                                       value="{{ old('center_address') }}" placeholder="Enter center address">
                                @error('center_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Center Email -->
                            <div class="col-md-6 mb-3">
                                <label for="center_email" class="form-label">Center Email <span class="text-danger">*</span></label>
                                <input type="email" name="center_email" class="form-control"
                                       value="{{ old('center_email') }}" placeholder="Enter center email">
                                @error('center_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone_number" class="form-control" 
                                       value="{{ old('phone_number') }}" placeholder="Enter phone number">
                            </div>

                            <!-- License Number -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">License Number <span class="text-danger">*</span></label>
                                <input type="text" name="license_number" class="form-control" 
                                       value="{{ old('license_number') }}" placeholder="Enter license number">
                            </div>

                            <!-- G Number -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">G Number <span class="text-danger">*</span></label>
                                <input type="text" name="g_number" class="form-control" 
                                       value="{{ old('g_number') }}" placeholder="Enter G number">
                            </div>

                            <!-- Facility Number -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Facility Number <span class="text-danger">*</span></label>
                                <input type="text" name="facility_number" class="form-control" 
                                       value="{{ old('facility_number') }}" placeholder="Enter facility number">
                            </div>

                            <!-- Licensing Officer Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Licensing Officer Name <span class="text-danger">*</span></label>
                                <input type="text" name="licensing_officer_name" class="form-control" 
                                       value="{{ old('licensing_officer_name') }}" placeholder="Enter licensing officer name">
                            </div>

                            <!-- Licensing Officer Email -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Licensing Officer Email <span class="text-danger">*</span></label>
                                <input type="email" name="licensing_officer_email" class="form-control" 
                                       value="{{ old('licensing_officer_email') }}" placeholder="Enter licensing officer email">
                            </div>

                            <!-- Licensing Officer Mobile -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Licensing Officer Mobile <span class="text-danger">*</span></label>
                                <input type="text" name="licensing_officer_mobile" class="form-control" 
                                       value="{{ old('licensing_officer_mobile') }}" placeholder="Enter licensing officer mobile">
                            </div>

                            <!-- Business License Doc -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Business License Doc</label>
                                <input type="file" name="business_license_doc" class="form-control">
                            </div>

                            <!-- Facility License Doc -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Facility License Doc</label>
                                <input type="file" name="facility_license_doc" class="form-control">
                            </div>

                            <!-- Incorporation Document -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Incorporation Document</label>
                                <input type="file" name="incorporation_doc" class="form-control">
                            </div>

                             <!-- CCOF Document< -->
                            <div class="col-md-4 mb-3">
                                <label class="form-label">CCOF Document</label>
                                <input type="file" name="ccof" class="form-control">
                            </div>
                            
                            <!--Inspection Reports -->
                             <div class="col-md-4 mb-3">
                                <label class="form-label">Inspection Reports</label>
                                <input type="file" name="inspection_reports" class="form-control">
                            </div>
                            
                            
                            <!-- Number of Classrooms -->
                            <div class="col-md-6 mb-3">
                                <label for="number_of_classrooms" class="form-label">Number of Classrooms <span class="text-danger">*</span></label>
                                <input type="number" name="number_of_classrooms" class="form-control"
                                       value="{{ old('number_of_classrooms') }}" placeholder="Enter number of classrooms">
                            </div>

                        </div> <!-- row end -->

                        <!-- Submit Buttons -->
                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary px-4">Create Center</button>
                            <a href="{{ url('center-managements') }}" class="btn btn-secondary px-4">Cancel</a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- FORM CARD END -->

</div>
@endsection
