@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1 class="page-title">Edit Center Management</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('center-managements') }}">Centers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Center</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Edit Center Information</h3>
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

                        <div class="form-group mb-3">
                            <label for="center_name" class="form-label">Center Name <span class="text-danger">*</span></label>
                            <input type="text" name="center_name" class="form-control" value="{{ $center->center_name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="center_address" class="form-label">Center Address <span class="text-danger">*</span></label>
                            <input type="text" name="center_address" class="form-control" value="{{ $center->center_address }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="center_email" class="form-label">Center Email <span class="text-danger">*</span></label>
                            <input type="email" name="center_email" class="form-control" value="{{ $center->center_email }}" required>
                        </div>


                            <div class="form-group mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="phone_number" class="form-control"
                                    value="{{ $center->phone_number }}">
                            </div>


                            <div class="form-group mb-3">
                                <label>License Number</label>
                                <input type="text" name="license_number" class="form-control"
                                    value="{{ $center->license_number}}">
                            </div>

                            <div class="form-group mb-3">
                                <label>G Number</label>
                                <input type="text" name="g_number" class="form-control" value="{{ $center->g_number }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Facility Number</label>
                                <input type="text" name="facility_number" class="form-control"
                                    value="{{ $center->facility_number }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Licensing Officer Name</label>
                                <input type="text" name="licensing_officer_name" class="form-control"
                                    value="{{ $center->licensing_officer_name }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Licensing Officer Email</label>
                                <input type="email" name="licensing_officer_email" class="form-control"
                                    value="{{ $center->licensing_officer_email }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Licensing Officer Mobile</label>
                                <input type="text" name="licensing_officer_mobile" class="form-control"
                                    value="{{ $center->licensing_officer_mobile }}">
                            </div>

                            <div class="form-group mb-3">
                                <label>Business License Doc : </label>
                                 @if($center->business_license_doc)
                                    <a href="{{ asset($center->business_license_doc) }}" target="_blank">View</a>
                                @endif
                                <input type="file" name="business_license_doc" class="form-control" >
                            </div>
                            
                            <div class="form-group mb-3">
                                <label>Facility License Doc : </label>
                                 @if($center->facility_license_doc)
                                    <a href="{{ asset($center->facility_license_doc) }}" target="_blank">View</a>
                                @endif
                                <input type="file" name="facility_license_doc" class="form-control" >
                            </div>

                            <div class="form-group mb-3">
                                <label>Incorporation Document : </label>
                                 @if($center->incorporation_doc)
                                    <a href="{{ asset($center->incorporation_doc) }}" target="_blank">View</a>
                                @endif
                                <input type="file" name="incorporation_doc" class="form-control" >
                            </div>

                            <!--<div class="form-group mb-3">-->
                            <!--    <label>Other File Upload</label>-->
                            <!--    <input type="file" name="other_file_doc" class="form-control">-->
                            <!--</div>-->
                            <!--<div class="form-group mb-3">-->
                            <!--    <label>Number of Classrooms</label>-->
                            <!--    <input type="number" name="number_of_classrooms" class="form-control"-->
                            <!--       value="{{ $center->number_of_classrooms }}" placeholder="Enter number of classrooms">-->
                            <!--</div>-->
                             <td> <a href="{{ route('center_managements.gallery', $center->center_id) }}" class="btn btn-sm btn-primary"> View Gallery</a></td>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Center</button>
                            <a href="{{ url('center-managements') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
