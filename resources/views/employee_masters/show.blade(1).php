@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Details</h2>
    <a href="{{ route('employee_masters.index') }}" class="btn btn-secondary mb-3">Back to List</a>

    <div class="card p-3">
        <p><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
        <p><strong>Mobile:</strong> {{ $employee->mobile_number }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>
        <p><strong>Designation:</strong> {{ $employee->designation }}</p>
        <p><strong>Primary Location:</strong> {{ $employee->primary_location }}</p>
        <p><strong>Start Date:</strong> {{ $employee->start_date }}</p>
        <p><strong>Probation End Period:</strong> {{ $employee->probation_end_period }}</p>

        <p><strong>Resume:</strong>
            @if($employee->resume)
                <a href="{{ asset($employee->resume) }}" target="_blank" class="btn btn-sm btn-info">View</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>ECE License Upload :</strong>
            @if($employee->ece_license)
                <a href="{{ asset($employee->ece_license) }}" target="_blank" class="btn btn-sm btn-info">View</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>ECE License Expiry:</strong> {{ $employee->ece_license_expiry }}</p>
        <p><strong>First Aid License:</strong>
            @if($employee->first_aid_license)
                <a href="{{ asset($employee->first_aid_license) }}" target="_blank" class="btn btn-sm btn-info">View</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>First Aid License Expiry:</strong> {{ $employee->first_aid_expiry }}</p>
        <p><strong>Police Clearance:</strong>
            @if($employee->police_clearance)
                <a href="{{ asset($employee->police_clearance) }}" target="_blank" class="btn btn-sm btn-info">View</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>Police Clearance Expiry:</strong> {{ $employee->police_clearance_expiry }}</p>
        <p><strong>Immunization Record:</strong>
            @if($employee->immunization_record)
                <a href="{{ asset($employee->immunization_record) }}" target="_blank" class="btn btn-sm btn-info">View</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>COVID-19 Vaccine Record:</strong>
            @if($employee->covid_vaccine_record)
                <a href="{{ asset($employee->covid_vaccine_record) }}" target="_blank" class="btn btn-sm btn-info">View</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>Three Written  Reference Letters:</strong>
            @if($employee->three_reference_letter)
                <a href="{{ asset($employee->three_reference_letter) }}" target="_blank" class="btn btn-sm btn-info">View</a>
            @else
                N/A
            @endif
        </p>
        <p><strong>Income Tax Forms, Averaging Agreement and VOID Cheque :</strong>
            @if($employee->signed_handbook)
                <a href="{{ asset($employee->signed_handbook) }}" target="_blank" class="btn btn-sm btn-info">View</a>
            @else
                N/A
            @endif
        </p>
       
    </div>
</div>
@endsection
