@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="margin-top: 180px; position: relative; z-index: 5;">
        <h1 class="h4 text-black fw-bold mb-0">Create Employee</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Employee</li>
        </ol>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm border-0">
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
            <form action="{{ route('employee_masters.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <!-- Basic Information -->
                    <div class="col-md-4">
                        <label class="form-label">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" class="form-control" >
                           @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" class="form-control" >
                           @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                        <input type="text" name="mobile_number" class="form-control" value="{{ old('phone_number') }}" placeholder="Enter phone number">
                           @error('mobile_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ old('center_email') }}" placeholder="Enter email">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- File Uploads -->
                    <div class="col-md-4">
                        <label class="form-label">Resume</label>
                        <input type="file" name="resume" class="form-control">
                    </div>
                    <div class="col-md-4" id="ece_license">
                        <label class="form-label">Upload ECE License (PDF)</label>
                        <input type="file" name="ece_license" accept="application/pdf" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">ECE License Expiry <span class="text-danger">*</span></label>
                        <input type="date" name="ece_license_expiry" value="{{ old('ece_license_expiry') }}" class="form-control">
                    </div>

                    <!-- Location and Designation -->
                    <div class="col-md-4">
                        <label class="form-label">Primary Location</label>
                        <select name="primary_location" id="institution_number" class="form-select" onchange="toggleprimary_location()">
                            <option value="">Select Institution</option>
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
                            <option value="">Select Designation</option>
                            <option value="ECE" {{ old('designation') == 'ECE' ? 'selected' : '' }}>ECE</option>
                            <option value="ECE-IT" {{ old('designation') == 'ECE-IT' ? 'selected' : '' }}>ECE-IT</option>
                            <option value="ECE IT/SN" {{ old('designation') == 'ECE IT/SN' ? 'selected' : '' }}>ECE IT/SN</option>
                            <option value="ECEA" {{ old('designation') == 'ECEA' ? 'selected' : '' }}>ECEA</option>
                            <option value="RA" {{ old('designation') == 'RA' ? 'selected' : '' }}>RA</option>
                            <option value="Management" {{ old('designation') == 'Management' ? 'selected' : '' }}>Management</option>
                            <option value="General Administration" {{ old('designation') == 'General Administration' ? 'selected' : '' }}>General Administration</option>
                        </select>
                    </div>

                    <!-- Other Licenses -->
                    <div class="col-md-4" id="first_aid_license">
                        <label class="form-label">Upload First Aid License (PDF)</label>
                        <input type="file" name="first_aid_license" accept="application/pdf" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">First Aid Expiry <span class="text-danger">*</span></label>
                        <input type="date" name="first_aid_expiry" value="{{ old('first_aid_expiry') }}" class="form-control">
                    </div>
                    <div class="col-md-4" id="police_clearance">
                        <label class="form-label">Upload Police Clearance (PDF)</label>
                        <input type="file" name="police_clearance" accept="application/pdf" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Police Clearance Expiry <span class="text-danger">*</span></label>
                        <input type="date" name="police_clearance_expiry" value="{{ old('police_clearance_expiry') }}" class="form-control">
                    </div>
                    <div class="col-md-4" id="immunization_record">
                        <label class="form-label">Upload Immunization Record (PDF)</label>
                        <input type="file" name="immunization_record" accept="application/pdf" class="form-control">
                    </div>
                    <div class="col-md-4" id="three_reference_letter">
                        <label class="form-label">Upload Three Reference Letters (PDF)</label>
                        <input type="file" name="three_reference_letter" accept="application/pdf" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Start Date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Probation End Date <span class="text-danger">*</span></label>
                        <input type="date" name="probation_end_period" value="{{ old('probation_end_period') }}" class="form-control">
                    </div>

                    <!-- Final Documents -->
                    <div class="col-md-4" id="custody_upload">
                        <label class="form-label">Upload Signed Handbook (PDF)</label>
                        <input type="file" name="signed_handbook" accept="application/pdf" class="form-control">
                    </div>
                    <div class="col-md-4" id="covid_vaccine_record">
                        <label class="form-label">Upload COVID Vaccine Record (PDF)</label>
                        <input type="file" name="covid_vaccine_record" accept="application/pdf" class="form-control">
                    </div>
                    <div class="col-md-4" id="legal_work_doc">
                        <label class="form-label">Upload Legal Work Document (PDF)</label>
                        <input type="file" name="legal_work_doc" accept="application/pdf" class="form-control">
                    </div>
                      <div class="col-md-4" id="income_tax_forms">
                         <label class="form-label">Upload income_tax_forms (PDF)</label>
                        <input type="file" name="income_tax_forms" accept="application/pdf" class="form-control">
                
                      </div>
                              @php
    $user = session('user');
@endphp


                <div class="col-md-4">
                <button type="submit" class="btn btn-success mt-4">Save</button>
                
                 </div> </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleprimary_location() {
        const selectedValue = document.getElementById('institution_number').value;
        const otherInstitutionDiv = document.getElementById('otherInstitutionDiv');
        if (otherInstitutionDiv) {
            otherInstitutionDiv.style.display = selectedValue === 'Other' ? 'block' : 'none';
        }
    }

    function toggledesignation() {
        const selectedValue = document.getElementById('designation').value;
        const otherInstitutionDiv = document.getElementById('otherInstitutionDiv');
        if (otherInstitutionDiv) {
            otherInstitutionDiv.style.display = selectedValue === 'Other' ? 'block' : 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleprimary_location();
        toggledesignation();
    });
</script>
@endsection
