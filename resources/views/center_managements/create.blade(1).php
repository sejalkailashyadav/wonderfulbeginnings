@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Create Center </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Center</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- FORM CARD -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">Center Information</h3>
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
                            <div class="form-group mb-3">
                                <label for="center_name" class="form-label">Center Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="center_name" class="form-control" value="{{ old('center_name') }}"
                                    placeholder="Enter center name" >
                            </div>
                            @error('center_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-group mb-3">
                                <label for="center_address" class="form-label">Center Address <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="center_address" class="form-control"
                                    value="{{ old('center_address') }}" placeholder="Enter center address">
                            </div>
                            @error('center_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="form-group mb-3">
                                <label for="center_email" class="form-label">Center Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="center_email" class="form-control"
                                    value="{{ old('center_email') }}" placeholder="Enter center email">
                            </div>
                            @error('center_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror


                            <div class="form-group mb-3">
                                <label>Phone Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="phone_number" class="form-control"  placeholder="Enter phone number"
                                    value="{{ old('phone_number') }}">
                            </div>

                          

                            <div class="form-group mb-3">
                                <label>License Number  <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="license_number" class="form-control"  placeholder="Enter License Number"
                                    value="{{ old('license_number') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>G Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="g_number" class="form-control" value="{{ old('g_number') }}"  placeholder="Enter G Number"> 
                            </div>

                            <div class="form-group mb-3">
                                <label>Facility Number <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="facility_number" class="form-control" placeholder="Enter Facility Name"
                                    value="{{ old('facility_number') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Licensing Officer Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="licensing_officer_name" class="form-control" placeholder="Enter Licensing Officer Name"
                                    value="{{ old('licensing_officer_name') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Licensing Officer Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" name="licensing_officer_email" class="form-control" placeholder="Enter Licensing Officer Email"
                                    value="{{ old('licensing_officer_email') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Licensing Officer Mobile <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="licensing_officer_mobile" class="form-control" placeholder="Enter Licensing Officer Mobile"
                                    value="{{ old('licensing_officer_mobile') }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Business License Doc</label>
                                <input type="file" name="business_license_doc" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Facility License Doc</label>
                                <input type="file" name="facility_license_doc" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Incorporation Document</label>
                                <input type="file" name="incorporation_doc" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label for="number_of_classrooms" class="form-label">Number of Classrooms<span
                                        class="text-danger">*</span></label></label>
                                <input type="number" name="number_of_classrooms" class="form-control"
                                   value="{{ old('number_of_classrooms') }}" placeholder="Enter number of classrooms">
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Create Center</button>
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