@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('employee_masters.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <br><br><br>
            <div class="col-md-6 mb-3">
                <label class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" name="first_name" class="form-control" required>
            </div>

             <div class="col-md-6 mb-3">
                 <label class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" name="last_name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                <input type="text" name="mobile_number" class="form-control" value="{{ old('phone_number') }}"
                    placeholder="Enter phone number">
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label"> Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control" value="{{ old('center_email') }}"
                    placeholder="Enter  email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">resume</label>
                <input type="file" name="resume" class="form-control">
            </div>

            <div class="col-md-6" id="ece_license" >
                <label class="form-label">Upload ece license (PDF)</label>
                <input type="file" name="ece_license" accept="application/pdf" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">ece license expiry <span class="text-danger">*</span></label>
                <input type="date" name="ece_license_expiry" value="{{ old('ece_license_expiry') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">primary_location</label>
                <select name="primary_location" id="institution_number" class="form-select"
                    onchange="toggleprimary_location()">
                    <option value="">Select Institution</option>
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
        <option value="ECE" {{ old('designation') == 'ECE' ? 'selected' : '' }}>ECE</option>
        <option value="ECE-IT" {{ old('designation') == 'ECE-IT' ? 'selected' : '' }}>ECE-IT</option>
        <option value="ECE IT/SN" {{ old('designation') == 'ECE IT/SN' ? 'selected' : '' }}>ECE IT/SN</option>
        <option value="ECEA" {{ old('designation') == 'ECEA' ? 'selected' : '' }}>ECEA</option>
        <option value="RA" {{ old('designation') == "RA" ? 'selected' : '' }}>RA</option>
        <option value="Management" {{ old('designation') == "Management" ? 'selected' : '' }}>Management</option>
        <option value="General Administration" {{ old('designation') == "General Administration" ? 'selected' : '' }}>General Administration</option>
    </select>
</div>


            <div class="col-md-6" id="first_aid_license">
                <label class="form-label">Upload first_aid_license (PDF)</label>
                <input type="file" name="first_aid_license" accept="application/pdf" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">first aid expiry <span class="text-danger">*</span></label>
                <input type="date" name="first_aid_expiry" value="{{ old('first_aid_expiry') }}" class="form-control">
            </div>
            <div class="col-md-6" id="police_clearance">
                <label class="form-label">Upload police_clearance (PDF)</label>
                <input type="file" name="police_clearance" accept="application/pdf" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">police clearance expiry <span class="text-danger">*</span></label>
                <input type="date" name="police_clearance_expiry" value="{{ old('police_clearance_expiry') }}"
                    class="form-control">
            </div>
            <div class="col-md-6" id="immunization_record">
                <label class="form-label">Upload immunization record (PDF)</label>
                <input type="file" name="immunization_record" accept="application/pdf" class="form-control">
            </div>

            <div class="col-md-6" id="three_reference_letter">
                <label class="form-label">Upload three_reference_letter(PDF)</label>
                <input type="file" name="three_reference_letter" accept="application/pdf" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label"> start_date <span class="text-danger">*</span></label>
                <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label"> probation_end date <span class="text-danger">*</span></label>
                <input type="date" name="probation_end_period" value="{{ old('probation_end_period') }}"
                    class="form-control">
            </div>

            <div class="col-md-6" id="custody_upload">
                <label class="form-label">Upload signed handbook (PDF)</label>
                <input type="file" name="signed_handbook" accept="application/pdf" class="form-control">
            </div>
            <div class="col-md-6" id="covid_vaccine_record">
                <label class="form-label">Upload covid vaccine record (PDF)</label>
                <input type="file" name="covid_vaccine_record" accept="application/pdf" class="form-control">
            </div>
            <div class="col-md-6" id="legal_work_doc">
                <label class="form-label">Upload legal_work_doc (PDF)</label>
                <input type="file" name="legal_work_doc" accept="application/pdf" class="form-control">
            </div>
            <div class="col-md-6" id="custody_upload">
                <label class="form-label">Upload income_tax_forms (PDF)</label>
                <input type="file" name="custody_agreement" accept="application/pdf" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-3">Save</button>
        </form>
    </div>
    <script>
        function toggleprimary_location() {
            const selectedValue = document.getElementById('institution_number').value;
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