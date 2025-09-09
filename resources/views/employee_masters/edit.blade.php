@extends('layouts.app')

@section('content')
<div class="container">
    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="margin-top: 180px; position: relative; z-index: 5;">
        <h1 class="h4 text-black fw-bold mb-0">Edit Employee</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Employee</li>
        </ol>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('employee_masters.update', $employee->emp_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-4">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" required value="{{ $employee->first_name }}">
                    </div>
                    <div class="col-md-4">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" required value="{{ $employee->last_name }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $employee->mobile_number) }}" placeholder="Enter phone number" required>
                    </div>

                    <div class="col-md-4">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ $employee->email }}" placeholder="Enter email">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Resume</label>
                        <input type="file" name="resume" class="form-control">
                        @if($employee->resume)
                            <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->resume) }}" target="_blank">View Current</a>
                        @endif
                    </div>
                    <div class="col-md-4" id="ece_license">
                        <label class="form-label">Upload ECE License (PDF)</label>
                        <input type="file" name="ece_license" accept="application/pdf" class="form-control">
                        @if($employee->ece_license)
                            <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->ece_license) }}" target="_blank">View Current</a>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">ECE License Expiry <span class="text-danger">*</span></label>
                        <input type="date" name="ece_license_expiry" value="{{ old('ece_license_expiry', $employee->ece_license_expiry) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Primary Location</label>
                        <select name="primary_location" id="primary_location" class="form-select" onchange="toggleprimary_location()">
                            <option value="">Select location</option>
                            <option value="Cocomelon - Downtown" {{ old('primary_location') == 'Cocomelon - Downtown' ? 'selected' : '' }}>Cocomelon - Downtown</option>
                            <option value="Cocomelon - 27th Avenue" {{ old('primary_location') == 'Cocomelon - 27th Avenue' ? 'selected' : '' }}>Cocomelon - 27th Avenue</option>
                            <option value="Cocomelon - 27th Street" {{ old('primary_location') == 'Cocomelon - 27th Street' ? 'selected' : '' }}>Cocomelon - 27th Street</option>
                            <option value="WB - Kamloops" {{ old('primary_location') == 'WB - Kamloops' ? 'selected' : '' }}>WB - Kamloops</option>
                            <option value="WB - Gordon" {{ old('primary_location') == 'WB - Gordon' ? 'selected' : '' }}>WB - Gordon</option>
                            <!--<option value="WB - Gallaghers" {{ old('primary_location') == 'WB - Gallaghers' ? 'selected' : '' }}>WB - Gallaghers</option>-->
                            <!--<option value="Cocomelon - Lumby" {{ old('primary_location') == 'Cocomelon - Lumby' ? 'selected' : '' }}>Cocomelon - Lumby</option>-->
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Designation</label>
                        <select name="designation" id="designation" class="form-select" onchange="toggledesignation()">
                            <option value="">Select designation</option>
                            <option value="ECE" {{ old('designation', $employee->designation) == 'ECE' ? 'selected' : '' }}>ECE</option>
                            <option value="ECE-IT" {{ old('designation', $employee->designation) == 'ECE-IT' ? 'selected' : '' }}>ECE-IT</option>
                            <option value="ECE IT/SN" {{ old('designation', $employee->designation) == 'ECE IT/SN' ? 'selected' : '' }}>ECE IT/SN</option>
                            <option value="ECEA" {{ old('designation', $employee->designation) == 'ECEA' ? 'selected' : '' }}>ECEA</option>
                            <option value="RA" {{ old('designation', $employee->designation) == 'RA' ? 'selected' : '' }}>RA</option>
                            <option value="Management" {{ old('designation', $employee->designation) == 'Management' ? 'selected' : '' }}>Management</option>
                            <option value="General Administration" {{ old('designation', $employee->designation) == 'General Administration' ? 'selected' : '' }}>General Administration</option>
                        </select>
                    </div>

                    @php
                        $pdfFields = [
                            'first_aid_license' => 'First Aid License',
                            'police_clearance' => 'Police Clearance',
                            'immunization_record' => 'Immunization Record',
                            'three_reference_letter' => 'Three Reference Letters',
                            'signed_handbook' => 'Signed Handbook',
                            'covid_vaccine_record' => 'COVID Vaccine Record',
                            'legal_work_doc' => 'Legal Work Document'
                        ];
                    @endphp

                    @foreach($pdfFields as $field => $label)
                        <div class="col-md-4" id="{{ $field }}">
                            <label class="form-label">Upload {{ $label }} (PDF)</label>
                            <input type="file" name="{{ $field }}" accept="application/pdf" class="form-control">
                            @if($employee->$field)
                                <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->$field) }}" target="_blank">View Current</a>
                            @endif
                        </div>
                    @endforeach

                    <div class="col-md-4">
                        <label class="form-label">First Aid Expiry <span class="text-danger">*</span></label>
                        <input type="date" name="first_aid_expiry" value="{{ old('first_aid_expiry', $employee->first_aid_expiry) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Police Clearance Expiry <span class="text-danger">*</span></label>
                        <input type="date" name="police_clearance_expiry" value="{{ old('police_clearance_expiry', $employee->police_clearance_expiry) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start Date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" value="{{ old('start_date', $employee->start_date) }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Probation End Date <span class="text-danger">*</span></label>
                        <input type="date" name="probation_end_period" value="{{ old('probation_end_period', $employee->probation_end_period) }}" class="form-control">
                    </div>
                </div>

                <button type="submit" class="btn btn-success mt-4">Save</button>
            </form>
        </div>
    </div>

    <script>
        function toggleprimary_location() {
            const selectedValue = document.getElementById('primary_location').value;
            if (selectedValue === 'Other') {
                otherInstitutionDiv.style.display = 'block';
            } else {
                otherInstitutionDiv.style.display = 'none';
            }
        }

        function toggledesignation() {
            const selectedValue = document.getElementById('designation').value;
            if (selectedValue === 'Other') {
                otherInstitutionDiv.style.display = 'block';
            } else {
                otherInstitutionDiv.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleprimary_location();
            toggledesignation();
        });
    </script>
</div>
@endsection
