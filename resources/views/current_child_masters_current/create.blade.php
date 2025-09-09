@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="margin-top: 180px; position: relative; z-index: 5;">
        <h1 class="h4 text-black fw-bold mb-0">Create Child Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Child</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- FORM CARD -->
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                      
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

    <form action="{{ route('current-child-masters.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- ================== CHILD DETAILS ================== -->
        <h3 class="card-title text-primary border-bottom pb-2 mt-3">Child Details</h3>
        <div class="row g-3 mt-2">
             <div class="col-12 text-center mb-3">
                <label class="form-label">Child Picture (optional)</label>
                <input type="file" name="child_picture" accept="image/*"  class="form-control w-50 mx-auto">
            </div>

            <div class="col-md-6" style="display:none;">
                <label class="form-label"></label>
                <select name="status" class="form-control" onchange="toggleWithdrawalFields(this.value)">
                    <option value="0" selected>Review</option>
                    <option value="1">Active</option>
                    <option value="2">Withdrawal</option>
                    <option value="3">Archive</option>
                </select>
            </div>

            <div id="withdrawal-fields" style="display:none;">
                <div class="col-md-4">
                    <label>Withdrawal Notice Received Date</label>
                    <input type="date" name="withdrawal_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Last Date of Attendance</label>
                    <input type="date" name="withdrawal_requeste_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Withdrawal Note</label>
                    <textarea name="withdrawal_note" class="form-control"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <label class="form-label">Child First Name <span class="text-danger">*</span></label>
                <input type="text" name="child_first_name" class="form-control" value="{{ old('child_first_name') }}" placeholder="Enter child's first name">
            </div>
            <div class="col-md-6">
                <label class="form-label">Child Last Name <span class="text-danger">*</span></label>
                <input type="text" name="child_last_name" class="form-control" value="{{ old('child_last_name') }}" placeholder="Enter child's last name">
            </div>

            <div class="col-md-6">
                <label class="form-label">Child DOB <span class="text-danger">*</span></label>
                <input type="date" name="child_dob" value="{{ old('child_dob') }}" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Health Card <span class="text-danger">*</span></label>
                <input type="text" name="health_card" class="form-control" value="{{ old('health_card') }}" placeholder="Enter Health Card #">
            </div>

            <div class="col-md-4">
                <label class="form-label">Center<span class="text-danger">*</span></label>
                <select id="center_id" name="center_id" class="form-control">
                    <option value="">Select Center</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->center_id }}" {{ old('center_id') == $center->center_id ? 'selected' : '' }}>{{ $center->center_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Class<span class="text-danger">*</span></label>
                <select id="class_id" name="class_id" class="form-control">
                    <option value="">Select Class</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Fee<span class="text-danger">*</span></label>
                <select id="fees_id" name="fees_id" class="form-control">
                    <option value="">Select Fee</option>
                </select>
            </div>


<div class="col-12">
    <label class="form-label">Days of Attendance<span class="text-danger">*</span></label><br>
    <div class="ps-3">
        @foreach($daysOfWeek as $day)
            <label class="me-3">
                <input type="checkbox" 
                       name="no_of_days[]" 
                       value="{{ $day }}" 
                       class="day-checkbox"
                       {{ in_array($day, $selectedDays ?? []) ? 'checked' : '' }}>
                {{ $day }}
            </label>
        @endforeach
    </div>
</div>


            <!--<div class="col-12">-->
            <!--    <label class="form-label">Days of Attendance</label><br>-->
            <!--    <div class="ps-3">-->
            <!--        @foreach($daysOfWeek as $day)-->
            <!--            <label class="me-3">-->
            <!--                <input type="checkbox" name="no_of_days[]" value="{{ $day }}" {{ in_array($day, $selectedDays ?? []) ? 'checked' : '' }}>-->
            <!--                {{ $day }}-->
            <!--            </label>-->
            <!--        @endforeach-->
            <!--    </div>-->
            <!--</div>-->
        </div>

        <!-- ================== PARENT DETAILS ================== -->
        <h3 class="card-title text-primary border-bottom pb-2 mt-5">Parent & Sibling Details</h3>
        <div class="row g-3 mt-2">
            <div class="col-md-6">
                <label class="form-label">Parent First Name <span class="text-danger">*</span></label>
                <input type="text" name="parent_first_name" class="form-control" value="{{ old('parent_first_name') }}" placeholder="Enter parent's first name">
            </div>
            <div class="col-md-6">
                <label class="form-label">Parent Last Name <span class="text-danger">*</span></label>
                <input type="text" name="parent_last_name" class="form-control" value="{{ old('parent_last_name') }}" placeholder="Enter parent's last name">
            </div>
            <div class="col-md-6">
                <label class="form-label">Parent Mobile Number <span class="text-danger">*</span></label>
                <input type="text" name="parent_mobile" class="form-control" value="{{ old('parent_mobile') }}" placeholder="Enter parent mobile number">
            </div>
            <div class="col-md-6">
                <label class="form-label">Parent Email <span class="text-danger">*</span></label>
                <input type="email" name="parent_email" class="form-control" value="{{ old('parent_email') }}" placeholder="Enter parent email">
            </div>

            <div class="col-md-6">
                <label class="form-label">Custody Agreement?<span class="text-danger">*</span></label>
                <select name="has_custody_agreement" id="has_custody_agreement" class="form-control">
                    <option value="0" {{ old('has_custody_agreement', isset($child) && $child->custody_agreement ? 1 : 0) == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('has_custody_agreement', isset($child) && $child->custody_agreement ? 1 : 0) == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div class="col-md-6" id="custody_upload" style="display:none;">
                <label class="form-label">Upload Custody Agreement (PDF)</label>
                <input type="file" name="custody_agreement" accept="application/pdf" class="form-control">
            </div>

            <div class="col-md-6">
                <label class="form-label">Is Sibling?<span class="text-danger">*</span></label>
                <select name="issibling" id="issibling" class="form-control">
                    <option value="0" {{ old('issibling', $child->issibling ?? 0) == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('issibling', $child->issibling ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
            <div class="col-md-6" id="sibling_select" style="display:none;">
                <label class="form-label">Select Sibling</label>
                <select name="sibling_child_id" class="form-control">
                    <option value="">-- Select --</option>
                    @foreach($allChildren as $sibling)
                        @if(empty($child) || $child->child_id != $sibling->child_id)
                            <option value="{{ $sibling->child_id }}" {{ old('sibling_child_id', $child->sibling_child_id ?? '') == $sibling->child_id ? 'selected' : '' }}>
                                {{ $sibling->child_first_name }} {{ $sibling->child_last_name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        
        <!-- ================== EMERGENCY CONTACTS ================== -->
<h3 class="card-title text-primary border-bottom pb-2 mt-4">Emergency Contacts Details</h3>
<div class="row g-3 mt-2">

    <!-- Emergency Contact 1 -->
    <div class="col-md-4">
        <label class="form-label">Emergency Contact Name<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name') }}" class="form-control" placeholder="Enter name">
        @error('emergency_contact_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Emergency Contact Number<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_number" value="{{ old('emergency_contact_number') }}" class="form-control" placeholder="Enter number">
        @error('emergency_contact_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Relationship<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_relations" value="{{ old('emergency_contact_relations') }}" class="form-control" placeholder="Enter relationship">
        @error('emergency_contact_relations')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Emergency Contact 2 -->
    <div class="col-md-4">
        <label class="form-label">Emergency Contact Name 2<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_name2" value="{{ old('emergency_contact_name2') }}" class="form-control" placeholder="Enter name">
        @error('emergency_contact_name2')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Emergency Contact Number 2<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_number2" value="{{ old('emergency_contact_number2') }}" class="form-control" placeholder="Enter number">
        @error('emergency_contact_number2')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Relationship 2<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_relation2" value="{{ old('emergency_contact_relation2') }}" class="form-control" placeholder="Enter relationship">
        @error('emergency_contact_relation2')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Emergency Contact 3 -->
    <div class="col-md-4">
        <label class="form-label">Emergency Contact Name 3<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_name3" value="{{ old('emergency_contact_name3') }}" class="form-control" placeholder="Enter name">
        @error('emergency_contact_name3')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Emergency Contact Number 3<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_number3" value="{{ old('emergency_contact_number3') }}" class="form-control" placeholder="Enter number">
        @error('emergency_contact_number3')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Relationship 3<span class="text-danger">*</span></label>
        <input type="text" name="emergency_contact_relation3" value="{{ old('emergency_contact_relation3') }}" class="form-control" placeholder="Enter relationship">
        @error('emergency_contact_relation3')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- ================== CHILD ADMISSION DETAILS ================== -->
<h3 class="card-title text-primary border-bottom pb-2 mt-5">Child Admission Details</h3>
<div class="row g-3 mt-2">

    <div class="col-md-6">
        <label class="form-label">Admission Date<span class="text-danger">*</span></label>
        <input type="date" name="admission_date" value="{{ old('admission_date') }}" class="form-control">
        @error('admission_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
 <div class="col-md-6">
        <label class="form-label">Registration Fees Paid<span class="text-danger">*</span></label>
        <input type="number" name="registration_fees_paid" value="{{ old('registration_fees_paid') }}" class="form-control" placeholder="Enter amount">
        @error('registration_fees_paid')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Institution Number<span class="text-danger">*</span></label>
        <select name="institution_number" id="institution_number" class="form-select" onchange="toggleOtherInstitution()">
            <option value="">Select Institution</option>
            <option value="BMO" {{ old('institution_number') == 'BMO' ? 'selected' : '' }}>Bank of Montreal - 001</option>
            <option value="SB" {{ old('institution_number') == 'SB' ? 'selected' : '' }}>Scotiabank (The Bank of Nova Scotia)- 002</option>
            <option value="RBC" {{ old('institution_number') == 'RBC' ? 'selected' : '' }}>Royal Bank of Canada- 003</option>
            <option value="TD" {{ old('institution_number') == 'TD' ? 'selected' : '' }}>The Toronto-Dominion Bank- 004</option>
            <option value="NBC" {{ old('institution_number') == "NBC" ? 'selected' : '' }}>National Bank of Canada- 006</option>
            <option value="CBC" {{ old('institution_number') == "CBC" ? 'selected' : '' }}>Canadian Imperial Bank of Commerce- 010</option>
        </select>
        @error('institution_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
 
    
    <div class="col-md-4" id="other_institution_div" style="display: none;">
        <label class="form-label">Other Institution Name<span class="text-danger">*</span></label>
        <input type="text" name="other_institution" id="other_institution" value="{{ old('other_institution') }}" class="form-control" placeholder="Enter institution name">
    </div>

    <div class="col-md-4">
        <label class="form-label">Bank Transit Number<span class="text-danger">*</span></label>
        <input type="text" name="transit_number" value="{{ old('transit_number') }}" class="form-control" placeholder="Enter transit number">
    </div>

    <div class="col-md-4">
        <label class="form-label">Account Number<span class="text-danger">*</span></label>
        <input type="text" name="account_number" value="{{ old('account_number') }}" class="form-control" placeholder="Enter account number">
        @error('account_number')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

   <div class="col-md-6">
        <label class="form-label">Upload Documents<span class="text-danger">*</span></label>
        <input type="file" name="registration_docs[]" class="form-control" multiple>
        <small class="text-muted">Upload PDFs: registration, PAD, authorizations, consent card</small>
    </div>

    <div class="col-md-6">
        <label class="form-label">Special Notes<span class="text-danger">*</span></label>
        <textarea name="special_notes" class="form-control" rows="3" placeholder="Enter any special notes"></textarea>
    </div>

   

    <div class="col-md-6">
        <input type="date" name="end_date" value="{{ old('end_date') }}" hidden>
    </div>
</div>

<!-- Submit Buttons -->
<div class="text-end mt-4">
    <button type="submit" class="btn btn-primary">Create Child</button>
    <a href="{{ url('current-child-masters') }}" class="btn btn-secondary">Cancel</a>
</div>

    </form>
</div>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const issibling = document.getElementById('issibling');
        const siblingSelect = document.getElementById('sibling_select');

        function toggleSiblingSelect() {
            if (issibling.value == '1') {
                siblingSelect.style.display = 'block';
            } else {
                siblingSelect.style.display = 'none';
            }
        }

        issibling.addEventListener('change', toggleSiblingSelect);
        toggleSiblingSelect(); // run on load
    });

document.addEventListener('DOMContentLoaded', () => {
    const sel  = document.getElementById('has_custody_agreement');
    const box  = document.getElementById('custody_upload');
    const show = () => box.style.display = sel.value === '1' ? 'block' : 'none';
    sel.addEventListener('change', show);
    show();              // run once on page load
});

  function toggleWithdrawalFields(value) {
        const section = document.getElementById('withdrawal-fields');
        section.style.display = (value == 2) ? 'block' : 'none';
    }
    
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const centerDropdown = document.getElementById('center_id');
    const classDropdown = document.getElementById('class_id');
    const feeDropdown = document.getElementById('fees_id');

    // Handle center selection
    centerDropdown.addEventListener('change', function () {
        const centerId = this.value;

        // Reset class and fees dropdowns
        classDropdown.innerHTML = '<option value="">Select Class</option>';
        feeDropdown.innerHTML = '<option value="">Select Fee</option>';

        if (centerId) {
            fetch(`/get-classes-by-center/${centerId}`)
                .then(res => res.json())
                .then(classes => {
                    classes.forEach(cls => {
                        const option = document.createElement('option');
                        option.value = cls.class_id;
                        option.textContent = cls.class_name;
                        classDropdown.appendChild(option);
                    });
                })
                .catch(err => console.error('Error fetching classes:', err));
        }
    });

    // Handle class selection
    classDropdown.addEventListener('change', function () {
        const classId = this.value;
        const centerId = centerDropdown.value;

        // Reset fees dropdown
        feeDropdown.innerHTML = '<option value="">Select Fee</option>';

        if (centerId && classId) {
            fetch(`/get-fees-by-center-and-class/${centerId}/${classId}`)
                .then(res => res.json())
                .then(fees => {
                    fees.forEach(fee => {
                        const option = document.createElement('option');
                        option.value = fee.id;
                        option.textContent = `${fee.fees_name}`;
                        feeDropdown.appendChild(option);
                    });
                })
                .catch(err => console.error('Error fetching fees:', err));
        }
    });
});


    function toggleOtherInstitution() {
        const selectedValue = document.getElementById('institution_number').value;
        const otherInstitutionDiv = document.getElementById('other_institution_div');
        if (selectedValue === 'Other') {
            otherInstitutionDiv.style.display = 'block';
        } else {
            otherInstitutionDiv.style.display = 'none';
        }
    }

    // To persist state after validation error
    document.addEventListener('DOMContentLoaded', function() {
        toggleOtherInstitution();
    });



    document.addEventListener('DOMContentLoaded', function() {
        const maxDays = 7; // Change this to your allowed number
        const checkboxes = document.querySelectorAll('.day-checkbox');

        checkboxes.forEach(cb => {
            cb.addEventListener('change', function() {
                const checkedCount = document.querySelectorAll('.day-checkbox:checked').length;
                if (checkedCount > maxDays) {
                    alert(`You can select only ${maxDays} days.`);
                    this.checked = false; // Uncheck the last one
                }
            });
        });
    });

//ch3cvkbox validation of days of attandance apart form days of week we can select any one of them 


document.addEventListener('DOMContentLoaded', function () {
    const feeDropdown = document.getElementById('fees_id');
    const dayCheckboxes = document.querySelectorAll('.day-checkbox');

    function applyDayLimit() {
        const selectedText = feeDropdown.options[feeDropdown.selectedIndex]?.text || '';
        const match = selectedText.match(/\d+/);
        const allowedDays = match ? parseInt(match[0], 10) : 0;

        let checkedCount = 0;
        dayCheckboxes.forEach(cb => {
            if (cb.checked) checkedCount++;
        });

        dayCheckboxes.forEach(cb => {
            if (cb.checked) {
                cb.disabled = false; // keep checked ones enabled
            } else if (checkedCount < allowedDays) {
                cb.disabled = false; // allow selection until limit is reached
            } else {
                cb.disabled = true; // disable the rest
            }
        });
    }

    // Run on dropdown change
    feeDropdown.addEventListener('change', applyDayLimit);

    // Also re-check when a checkbox changes
    dayCheckboxes.forEach(cb => {
        cb.addEventListener('change', applyDayLimit);
    });

    // If dropdown is loaded via AJAX, wait until populated
    const checkInterval = setInterval(() => {
        if (feeDropdown.options.length > 1 && feeDropdown.selectedIndex > 0) {
            applyDayLimit();
            clearInterval(checkInterval);
        }
    }, 200);
});


</script>
@endsection