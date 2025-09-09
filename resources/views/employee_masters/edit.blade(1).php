@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>edit Employee</h2>

        <form action="{{ route('employee_masters.update', $employee->emp_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                    

            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" required
                    value="{{ $employee->first_name }}">
            </div>


            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" required value="{{ $employee->last_name }}>
                    </div>

                    <div class=" col-md-6 mb-3">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input type="text" name="mobile_number" class="form-control"
                    value="{{ old('mobile_number', $employee->mobile_number) }}" placeholder="Enter phone number" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label"> Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ $employee->email }}"
                    placeholder="Enter email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Resume</label>
                <input type="file" name="resume" class="form-control">
                @if($employee->resume)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->resume) }}" target="_blank">View Current</a>
                @endif
            </div>
            <div class="col-md-6" id="ece_license">
                <label class="form-label">Upload ECE License (PDF)</label>
                <input type="file" name="ece_license" accept="application/pdf" class="form-control">
                @if($employee->ece_license)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->ece_license) }}" target="_blank">View Current</a>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">ECE License Expiry <span class="text-danger">*</span></label>
                <input type="date" name="ece_license_expiry"
                    value="{{ old('ece_license_expiry', $employee->ece_license_expiry) }}" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">primary_location</label>
                <select name="primary_location" id="primary_location" class="form-select"
                    onchange="toggleprimary_location()">
                    <option value="">Select location</option>
                    <option value="Cocomelon - Downtown" {{ old('primary_location') == 'Cocomelon - Downtown' ? 'selected' : '' }}>Cocomelon - Downtown </option>
                    <option value="Cocomelon - 27th Avenue" {{ old('primary_location') == 'Cocomelon - 27th Avenue' ? 'selected' : '' }}>Cocomelon - 27th Avenue</option>
                    <option value="Cocomelon - 27th Street" {{ old('primary_location') == 'Cocomelon - 27th Street' ? 'selected' : '' }}>Cocomelon - 27th Street</option>
                    <option value="WB - Kamloops" {{ old('primary_location') == 'WB - Kamloops' ? 'selected' : '' }}>WB -
                        Kamloops</option>
                    <option value="WB - Gordon" {{ old('primary_location') == "WB - Gordon" ? 'selected' : '' }}>WB - Gordon
                    </option>
                    <option value="WB - Gallaghers" {{ old('primary_location') == "WB - Gallaghers" ? 'selected' : '' }}>WB -
                        Gallaghers</option>
                    <option value="Cocomelon - Lumby" {{ old('primary_location') == "Cocomelon - Lumby" ? 'selected' : '' }}>
                        Cocomelon - Lumby</option>
                </select>

            </div>
            <div class="col-md-4">
                <label class="form-label">Designation</label>
                <select name="designation" id="designation" class="form-select" onchange="toggledesignation()">
                    <option value="">Select designation</option>
                    <option value="ECE" {{ old('designation', $employee->designation) == 'ECE' ? 'selected' : '' }}>ECE
                    </option>
                    <option value="ECE-IT" {{ old('designation', $employee->designation) == 'ECE-IT' ? 'selected' : '' }}>
                        ECE-IT</option>
                    <option value="ECE IT/SN" {{ old('designation', $employee->designation) == 'ECE IT/SN' ? 'selected' : '' }}>ECE IT/SN</option>
                    <option value="ECEA" {{ old('designation', $employee->designation) == 'ECEA' ? 'selected' : '' }}>ECEA
                    </option>
                    <option value="RA" {{ old('designation', $employee->designation) == 'RA' ? 'selected' : '' }}>RA</option>
                    <option value="Management" {{ old('designation', $employee->designation) == 'Management' ? 'selected' : '' }}>Management</option>
                    <option value="General Administration" {{ old('designation', $employee->designation) == 'General Administration' ? 'selected' : '' }}>General Administration</option>
                </select>
            </div>

            <div class="col-md-6" id="first_aid_license">
                <label class="form-label">Upload First Aid License (PDF)</label>
                <input type="file" name="first_aid_license" accept="application/pdf" class="form-control">
                @if($employee->first_aid_license)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->first_aid_license) }}" target="_blank">View Current</a>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">First Aid Expiry <span class="text-danger">*</span></label>
                <input type="date" name="first_aid_expiry"
                    value="{{ old('first_aid_expiry', $employee->first_aid_expiry) }}" class="form-control">
            </div>

            <div class="col-md-6" id="police_clearance">
                <label class="form-label">Upload Police Clearance (PDF)</label>
                <input type="file" name="police_clearance" accept="application/pdf" class="form-control">
                @if($employee->police_clearance)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->police_clearance) }}" target="_blank">View Current</a>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">Police Clearance Expiry <span class="text-danger">*</span></label>
                <input type="date" name="police_clearance_expiry"
                    value="{{ old('police_clearance_expiry', $employee->police_clearance_expiry) }}" class="form-control">
            </div>

            <div class="col-md-6" id="immunization_record">
                <label class="form-label">Upload Immunization Record (PDF)</label>
                <input type="file" name="immunization_record" accept="application/pdf" class="form-control">
                @if($employee->immunization_record)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->immunization_record) }}" target="_blank">View Current</a>
                @endif
            </div>

            <div class="col-md-6" id="three_reference_letter">
                <label class="form-label">Upload Three Reference Letters (PDF)</label>
                <input type="file" name="three_reference_letter" accept="application/pdf" class="form-control">
                @if($employee->three_reference_letter)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->three_reference_letter) }}" target="_blank">View Current</a>
                @endif
            </div>

            <div class="col-md-6">
                <label class="form-label">Start Date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" value="{{ old('start_date', $employee->start_date) }}"
                    class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Probation End Date <span class="text-danger">*</span></label>
                <input type="date" name="probation_end_period"
                    value="{{ old('probation_end_period', $employee->probation_end_period) }}" class="form-control">
            </div>

            <div class="col-md-6" id="custody_upload">
                <label class="form-label">Upload Signed Handbook (PDF)</label>
                <input type="file" name="signed_handbook" accept="application/pdf" class="form-control">
                @if($employee->signed_handbook)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->signed_handbook) }}" target="_blank">View Current</a>
                @endif
            </div>

            <div class="col-md-6" id="covid_vaccine_record">
                <label class="form-label">Upload COVID Vaccine Record (PDF)</label>
                <input type="file" name="covid_vaccine_record" accept="application/pdf" class="form-control">
                @if($employee->covid_vaccine_record)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->covid_vaccine_record) }}" target="_blank">View Current</a>
                @endif
            </div>

            <div class="col-md-6" id="legal_work_doc">
                <label class="form-label">Upload Legal Work Document (PDF)</label>
                <input type="file" name="legal_work_doc" accept="application/pdf" class="form-control">
                @if($employee->legal_work_doc)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->legal_work_doc) }}" target="_blank">View Current</a>
                @endif
            </div>

            <div class="col-md-6" id="custody_upload">
                <label class="form-label">Upload Income Tax Forms (PDF)</label>
                <input type="file" name="custody_agreement" accept="application/pdf" class="form-control">
                @if($employee->custody_agreement)
                    <a href="{{ asset('https://erp.cocomelonlearning.com/' . $employee->custody_agreement) }}" target="_blank">View Current</a>
                @endif
            </div>

            <button type="submit" class="btn btn-success mt-3">Save</button>
        </form>
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

        // To persist state after validation error
        document.addEventListener('DOMContentLoaded', function () {
            toggleprimary_location();
        });



        function toggledesignation() {
            const selectedValue = document.getElementById('designation').value;
            if (selectedValue === 'Other') {
                otherInstitutionDiv.style.display = 'block';
            } else {
                otherInstitutionDiv.style.display = 'none';
            }
        }

        // To persist state after validation error
        document.addEventListener('DOMContentLoaded', function () {
            toggledesignation();
        });


    </script>
@endsection