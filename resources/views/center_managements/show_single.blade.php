@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1 class="page-title">My Center Details</h1>
    </div>

    <div class="card custom-card shadow-sm border-0">
        <div class="card-body">
            <h3 class="mb-4">{{ $center->center_name }}</h3>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Address:</strong> {{ $center->center_address }}</p>
                    <p><strong>Email:</strong> {{ $center->center_email }}</p>
                    <p><strong>Phone:</strong> {{ $center->phone_number }}</p>
                    <p><strong>License No:</strong> {{ $center->license_number }}</p>
                    <p><strong>G Number:</strong> {{ $center->g_number }}</p>
                    <p><strong>Facility Number:</strong> {{ $center->facility_number }}</p>
                    <p><strong>Licensing Officer Name:</strong> {{ $center->licensing_officer_name }}</p>
                </div>

                <div class="col-md-6">
                    <p><strong>Licensing Officer Email:</strong> {{ $center->licensing_officer_email }}</p>
                    <p><strong>Licensing Officer Mobile:</strong> {{ $center->licensing_officer_mobile }}</p>
                    <p><strong>Number of Classrooms:</strong> {{ $center->classes_count }}</p>
                    <p><strong>Business License:</strong>
                        <a href="{{ $center->business_license_doc }}" target="_blank">View</a>
                    </p>
                    <p><strong>Facility License:</strong>
                        <a href="{{ $center->facility_license_doc }}" target="_blank">View</a>
                    </p>
                    <p><strong>Incorporation Doc:</strong>
                        <a href="{{ $center->incorporation_doc }}" target="_blank">View</a>
                    </p>
                    <p><strong>Gallery:</strong>
                        <a href="{{ route('center_managements.gallery', $center->center_id) }}"
                            class="btn btn-sm btn-primary">View Gallery</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

