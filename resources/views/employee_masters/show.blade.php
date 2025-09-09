@extends('layouts.app')

@section('content')
<div class="container">
    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="position: relative; z-index: 5;">
        <h1 class="h4 text-black fw-bold mb-0">Employee Details</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee Details</li>
        </ol>
    </div>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('employee_masters.index') }}" class="btn btn-secondary">← Back to List</a>
    </div>

    <!-- Employee Details Card -->
    <div class="card p-4">
        <div class="row">
            <div class="col-md-3 mb-3">
                <strong>Name:</strong>
                <p>{{ $employee->first_name }} {{ $employee->last_name }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Mobile:</strong>
                <p>{{ $employee->mobile_number }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Email:</strong>
                <p>{{ $employee->email }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Designation:</strong>
                <p>{{ $employee->designation }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Primary Location:</strong>
                <p>{{ $employee->primary_location }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Start Date:</strong>
                <p>{{ $employee->start_date }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Probation End Period:</strong>
                <p>{{ $employee->probation_end_period }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Resume:</strong><br>
                @if($employee->resume)
                    <a href="{{ asset($employee->resume) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                @else
                    <p>N/A</p>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <strong>ECE License:</strong><br>
                @if($employee->ece_license)
                    <a href="{{ asset($employee->ece_license) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                @else
                    <p>N/A</p>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <strong>ECE License Expiry:</strong>
                <p>{{ $employee->ece_license_expiry }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>First Aid License:</strong><br>
                @if($employee->first_aid_license)
                    <a href="{{ asset($employee->first_aid_license) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                @else
                    <p>N/A</p>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <strong>First Aid License Expiry:</strong>
                <p>{{ $employee->first_aid_expiry }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Police Clearance:</strong><br>
                @if($employee->police_clearance)
                    <a href="{{ asset($employee->police_clearance) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                @else
                    <p>N/A</p>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <strong>Police Clearance Expiry:</strong>
                <p>{{ $employee->police_clearance_expiry }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Immunization Record:</strong><br>
                @if($employee->immunization_record)
                    <a href="{{ asset($employee->immunization_record) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                @else
                    <p>N/A</p>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <strong>COVID-19 Vaccine Record:</strong><br>
                @if($employee->covid_vaccine_record)
                    <a href="{{ asset($employee->covid_vaccine_record) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                @else
                    <p>N/A</p>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <strong>Three Written Reference Letters:</strong><br>
                @if($employee->three_reference_letter)
                    <a href="{{ asset($employee->three_reference_letter) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                @else
                    <p>N/A</p>
                @endif
            </div>
            <div class="col-md-3 mb-3">
                <strong>Income Tax Forms, Averaging Agreement and VOID Cheque:</strong><br>
                @if($employee->signed_handbook)
                    <a href="{{ asset($employee->signed_handbook) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                @else
                    <p>N/A</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
