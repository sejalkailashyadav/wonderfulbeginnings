@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title"> Edit Child Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Child</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- FORM CARD -->
        <div class="row">
            <div class="col-md-10 mx-auto">
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

                        <form action="{{ url('current-child-masters/' . $child->child_id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <h3 class="card-title text-primary border-bottom pb-5 pt-5">Child Information</h3>  
<div class="row">
                            {{-- Profile Picture --}}
                            @if ($child->child_picture)
                                <div class="text-center mb-4">
                                    <img src="{{ asset($child->child_picture) }}" width="100" class="rounded-circle shadow-sm" alt="Child Profile Picture">
                                </div>
                            @endif
                            
                            <div class="form-group text-center">
                                <label for="child_picture">Change Profile Picture</label><br>
                                <input type="file" name="child_picture" id="child_picture" class="form-control-file mt-2">
                            </div>

                                 <div class="col-md-6 mb-3">        
                                <!--<select id="center_id" name="center_id" class="form-control mb-3" required>-->
                                <!--        <option value="">Select Center</option>-->
                                <!--        @foreach($centers as $center)-->
                                <!--            <option value="{{ $center->center_id }}" {{ old('center_id', $center->center_id ?? '') == $center->center_id ? 'selected' : '' }}>-->
                                <!--                {{ $center->center_name }}-->
                                <!--            </option>-->
                                <!--        @endforeach-->
                                <!--    </select>-->
                                    
                                <!--    <select id="class_id" name="class_id" class="form-control mb-3"  required>-->
                                <!--        <option value="">Select Class</option>-->
                                <!--    </select>-->
                                    
                                <!--    <select id="fees_id" name="fees_id" class="form-control mb-3"  required>-->
                                <!--        <option value="">Select Fee</option>-->
                                <!--    </select>-->



                                <select id="center_id" name="center_id" class="form-control mb-3" >
                                    <option value="">Select Center</option>
                                    @foreach($centers as $center)
                                        <option value="{{ $center->center_id }}" 
                                            {{ old('center_id', $child->center_id ?? '') == $center->center_id ? 'selected' : '' }}>
                                            {{ $center->center_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select id="class_id" name="class_id" class="form-control mb-3" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->class_id }}" 
                                            {{ old('class_id', $child->class_id ?? '') == $class->class_id ? 'selected' : '' }}>
                                            {{ $class->class_name }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                <select id="fees_id" name="fees_id" class="form-control mb-3" >
                                    <option value="">Select Fee</option>
                                    @foreach($fees as $fee)
                                        <option value="{{ $fee->id }}"
                                            {{ old('fees_id', $child->fees_id ?? '') == $fee->id ? 'selected' : '' }}>
                                            {{ $fee->fees_name }}
                                        </option>
                                    @endforeach
                                </select>

                                 </div>
                                 
                                 
                                </div>
                            <div class="row">
                                
                                                        
                            <div class="mb-3">
                                <label class="form-label">Days of Attendance</label><br>
                                <div style="padding-left: 39px;">
                                @foreach($daysOfWeek as $day)
                                    <label class="me-3">
                                        <input type="checkbox" name="no_of_days[]" value="{{ $day }}"
                                            {{ in_array($day, $selectedDays ?? []) ? 'checked' : '' }}>
                                        {{ $day }}
                                    </label>
                                @endforeach
                                </div>
                            </div>
<h3 class="card-title text-primary border-bottom pb-5 pt-5">Personal & Parent Information</h3>    
                            <div class="col-md-6 mb-3">
                                <label for="child_first_name" class="form-label">Child First Name</label>
                                <input type="text" name="child_first_name" class="form-control"
                                    value="{{ $child->child_first_name }}" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="child_last_name" class="form-label">Child Last Name</label>
                                <input type="text" name="child_last_name" class="form-control"
                                    value="{{ $child->child_last_name }}" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="parent_first_name" class="form-label">Parent First Name</label>
                                <input type="text" name="parent_first_name" class="form-control"
                                    value="{{ $child->parent_first_name }}" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="parent_last_name" class="form-label">Parent Last Name</label>
                                <input type="text" name="parent_last_name" class="form-control"
                                    value="{{ $child->parent_last_name }}" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="parent_mobile" class="form-label">Parent Mobile Number</label>
                                <input type="text" name="parent_mobile" class="form-control"
                                    value="{{ $child->parent_mobile }}" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="parent_email" class="form-label">Parent Email</label>
                                <input type="email" name="parent_email" class="form-control"
                                    value="{{ $child->parent_email }}" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="child_dob" class="form-label">Child DOB</label>
                                <input type="date" name="child_dob" class="form-control" value="{{ $child->child_dob }}"
                                    >
                            </div>

                           
                            

                            <!-- Custody Agreement -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Custody Agreement</label>
                                <select name="has_custody_agreement" class="form-control">
                                    <option value="No" {{ $child->has_custody_agreement == 'No' ? 'selected' : '' }}>No
                                    </option>
                                    <option value="Yes" {{ $child->has_custody_agreement == 'Yes' ? 'selected' : '' }}>Yes
                                    </option>
                                </select>
                            </div>
                        
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload Custody Agreement</label>
                                 <a href="{{ asset($child->custody_agreement) }}" target="_blank">View</a>
                                <input type="file" name="custody_agreement" class="form-control">
                                <small class="text-muted">Leave blank to keep current file</small>
                            </div>



                            <div class="col-md-6 mb-3">
                                <label class="form-label">Is Sibling?</label>
                                <select name="issibling" id="issibling" class="form-control">
                                    <option value="0" {{ old('issibling', $child->issibling) == 0 ? 'selected' : '' }}>No
                                    </option>
                                    <option value="1" {{ old('issibling', $child->issibling) == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                </select>
                            </div>


                            <div class="col-md-6 mb-3" id="sibling_select" style="display: none;">
                                <label class="form-label">Select Sibling</label>
                                <select name="sibling_child_id" class="form-control">
                                    <option value="">-- Select --</option>
                                    @foreach($allChildren as $sibling)
                                        <option value="{{ $sibling->child_id }}" {{ old('sibling_child_id', $child->sibling_child_id) == $sibling->child_id ? 'selected' : '' }}>
                                            {{ $sibling->child_first_name }} {{ $sibling->child_last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

         <h3 class="card-title text-primary border-bottom pb-5 pt-5">Emergency Contacts Details</h3>             
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact_name" class="form-label">Emergency Contact Name</label>
                            <input type="text" name="emergency_contact_name" class="form-control"
                                   value="{{ old('emergency_contact_name', $child->emergency_contact_name) }}"
                                   placeholder="Enter emergency contact name">
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact_number" class="form-label">Emergency Contact Number</label>
                            <input type="text" name="emergency_contact_number" class="form-control"
                                   value="{{ old('emergency_contact_number', $child->emergency_contact_number) }}"
                                   placeholder="Enter emergency contact number">
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact_relation" class="form-label">Emergency Contact Relationship</label>
                            <input type="text" name="emergency_contact_relations" class="form-control"
                                   value="{{ old('emergency_contact_relations', $child->emergency_contact_relations) }}"
                                   placeholder="Enter emergency contact relationship">
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact_name2" class="form-label">Emergency Contact Name 2</label>
                            <input type="text" name="emergency_contact_name2" class="form-control"
                                   value="{{ old('emergency_contact_name2', $child->emergency_contact_name2) }}"
                                   placeholder="Enter second emergency contact name">
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact_number2" class="form-label">Emergency Contact Number 2</label>
                            <input type="text" name="emergency_contact_number2" class="form-control"
                                   value="{{ old('emergency_contact_number2', $child->emergency_contact_number2) }}"
                                   placeholder="Enter second emergency contact number">
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="emergency_contact_relation2" class="form-label">Emergency Contact Relationship 2</label>
                            <input type="text" name="emergency_contact_relation2" class="form-control"
                                   value="{{ old('emergency_contact_relation2', $child->emergency_contact_relation2) }}"
                                   placeholder="Enter second emergency contact relationship">
                        </div>
                             <div class="col-md-6 mb-3">
                                    <label class="form-label">Emergency Contact Name 3</label>
                                    <input type="text" name="emergency_contact_name3" class="form-control"    value="{{ old('emergency_contact_name3', $child->emergency_contact_name3) }}"
                                    placeholder="Enter emergency contact name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Emergency Contact Number 3</label>
                                    <input type="text" name="emergency_contact_number3" class="form-control" 
                                      value="{{ old('emergency_contact_number3', $child->emergency_contact_number3) }}"
                                      placeholder="Enter emergency contact number" >
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Emergency Contact Relationship 3</label>
                                    
                                    <input type="text" name="emergency_contact_relation3" class="form-control"
                                      value="{{ old('emergency_contact_relation3', $child->emergency_contact_relation3) }}"
                                      placeholder="Enter emergency contact Relationship">
                                </div>
<h3 class="card-title text-primary border-bottom pb-5 pt-5">Child Admission Details</h3>   
                                
                            <div class="col-md-6 mb-3">
                                <label for="admission_date" class="form-label">Admission Date</label>
                                <input type="date" name="admission_date" class="form-control"
                                    value="{{ $child->admission_date }}" >
                            </div>
<div class="col-md-6 mb-3">
    <label for="institution_number" class="form-label">Institution Number <span class="text-danger">*</span></label>
    <select name="institution_number" id="institution_number" class="form-select" onchange="toggleOtherInstitution()">
        <option value="">Select Institution</option>
        <option value="CIBC" {{ (old('institution_number', $child->institution_number) == 'CIBC') ? 'selected' : '' }}>CIBC</option>
        <option value="RBC" {{ (old('institution_number', $child->institution_number) == 'RBC') ? 'selected' : '' }}>RBC</option>
        <option value="BMO" {{ (old('institution_number', $child->institution_number) == 'BMO') ? 'selected' : '' }}>BMO</option>
        <option value="TD" {{ (old('institution_number', $child->institution_number) == 'TD') ? 'selected' : '' }}>TD</option>
        <option value="CUs" {{ (old('institution_number', $child->institution_number) == 'CUs') ? 'selected' : '' }}>CU's</option>
        <option value="Other" 
            @if (!in_array(old('institution_number', $child->institution_number), ['CIBC', 'RBC', 'BMO', 'TD', 'CUs']) && old('institution_number', $child->institution_number) != '') 
                selected 
            @endif
        >Other</option>
    </select>
    @error('institution_number')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mb-3" id="other_institution_div" style="display: none;">
    <label for="other_institution" class="form-label">Other Institution Name <span class="text-danger">*</span></label>
    <input type="text" name="other_institution" id="other_institution" class="form-control" 
        value="{{ old('other_institution', (!in_array($child->institution_number, ['CIBC', 'RBC', 'BMO', 'TD', 'CUs']) ? $child->institution_number : '')) }}" 
        placeholder="Enter institution name">
    @error('other_institution')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>



                            <div class="col-md-6 mb-3">
                                <label for="transit_number" class="form-label">Bank Transit Number</label>
                                <input type="text" name="transit_number" class="form-control"
                                    value="{{ $child->transit_number }}" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="account_number" class="form-label">Account Number</label>
                                <input type="text" name="account_number" class="form-control"
                                    value="{{ $child->account_number }}" >
                            </div>
                            <!--<div class="col-md-6 mb-3">-->
                            <!--    <label for="end_date" class="form-label">End Date</label>-->
                            <!--    <input type="date" name="end_date" class="form-control" value="{{ $child->end_date }}">-->
                            <!--</div>-->

                            <div class="col-md-6 mb-3">
                                <label for="registration_fees_paid" class="form-label">Registration Fees Paid</label>
                                <input type="number" name="registration_fees_paid" class="form-control"
                                    value="{{ $child->registration_fees_paid }}">
                            </div>


                            <div class="col-md-6 mb-3">
                                <label for="special_notes" class="form-label">Special Notes</label>
                                <textarea name="special_notes" class="form-control"
                                    rows="3">{{ $child->special_notes }}</textarea>
                            </div>
                            
                             <div class="col-md-12 mb-3">
                            <!-- Document Upload -->
                            @if (!empty($child->other_file_doc))
                                @php $docs = json_decode($child->other_file_doc, true); @endphp
                                <label>Existing Registration Documents:</label>
                                <ul>
                                    @foreach ($docs as $doc)
                                        <li>
                                            <a href="{{ asset($doc) }}" target="_blank">{{ basename($doc) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                          
                                <label class="form-label">Upload Documents</label>
                                <input type="file" name="registration_docs[]" class="form-control" multiple>
                                <small class="text-muted">Leave blank to keep existing documents</small>
                            </div>
                    </div>
                </div>
                </div>
                            <div class="col-md-12 mb-3">

                                @if ($child->status == 0)
                                    {{-- Approve button --}}
                                    <input type="hidden" name="status" value="1"> {{-- 1 = Active --}}
                                    <div class="form-group text-center mt-4">
                                        <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                                    </div>
                                @elseif ($child->status == 1)
                                    {{-- Withdraw button (show form on click) --}}
                                    <div class="form-group text-center mt-4">
                                        <button type="button" class="btn btn-danger" onclick="showWithdrawalForm()">Withdraw</button>
                                    </div>
                                
                                    <div id="withdrawal-fields" class="mt-4" style="display: none;">
                                        <!--<input type="hidden" name="status" value="2"> {{-- 2 = Withdrawal --}}-->
                                        <div class="form-group">
                                            <label for="withdrawal_date">Withdrawal Last Date</label>
                                            <input type="date" name="withdrawal_date" class="form-control">
                                        </div>
                                         <div class="form-group">
                                            <label for="withdrawal_requeste_date">Withdrawal Requested Date</label>
                                             <input type="date" name="withdrawal_requeste_date" class="form-control">
                                          </div>
                                        <div class="form-group">
                                            <label for="withdrawal_note">Withdrawal Note</label>
                                            <textarea name="withdrawal_note" class="form-control"></textarea>
                                        </div>
                                        <div class="text-center">
                                            <!--<button type="submit" name="action" value="withdraw" class="btn btn-danger">Confirm Withdrawal</button>-->
                                            <button type="submit" name="action" value="withdraw" class="btn btn-danger" onclick="prepareWithdrawal(event)">Confirm Withdrawal</button>

                                        </div>
                                    </div>
                                @endif
                                </div>
                                
                                

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update Child</button>
                        <a href="{{ url('current-child-masters') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                      
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
    function showWithdrawalForm() {
        document.getElementById('withdrawal-fields').style.display = 'block';
    }

    function prepareWithdrawal(event) {
        // Add hidden status=2 input before submitting
        const form = event.target.closest('form');

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'status';
        input.value = '2';
        form.appendChild(input);
    }
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            toggleSiblingSelect();
        });
        
          function toggleWithdrawalFields(value) {
        const section = document.getElementById('withdrawal-fields');
        section.style.display = (value == 2) ? 'block' : 'none';
    }
    
     function showWithdrawalForm() {
        document.getElementById('withdrawal-fields').style.display = 'block';
    }
    

    </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    
    
// document.getElementById('center_id').addEventListener('change', function () {
//     let centerId = this.value;
//     let classDropdown = document.getElementById('class_id');
//     let feeDropdown = document.getElementById('fees_id');

//     // Clear both dropdowns
//     classDropdown.innerHTML = '<option value="">Select Class</option>';
//     feeDropdown.innerHTML = '<option value="">Select Fee</option>';

//     if (centerId) {
//         fetch(`/get-classes-by-center/${centerId}`)
//             .then(response => response.json())
//             .then(data => {
//                 data.forEach(cls => {
//                     let option = document.createElement('option');
//                     option.value = cls.class_id;
//                     option.textContent = cls.class_name;
//                     classDropdown.appendChild(option);
//                 });
//             });
//     }
// });

// document.getElementById('class_id').addEventListener('change', function () {
//     let centerId = document.getElementById('center_id').value;
//     let classId = this.value;
//     let feeDropdown = document.getElementById('fees_id');

//     feeDropdown.innerHTML = '<option value="">Select Fee</option>';

//     if (centerId && classId) {
//         fetch(`/get-fees-by-center-and-class/${centerId}/${classId}`)
//             .then(response => response.json())
//             .then(data => {
//                 data.forEach(fee => {
//                     let option = document.createElement('option');
//                     option.value = fee.id;
//                     option.textContent = fee.fees_name ;
//                     feeDropdown.appendChild(option);
//                 });
//             });
//     }
// });


document.addEventListener('DOMContentLoaded', function () {
    const centerDropdown = document.getElementById('center_id');
    const classDropdown = document.getElementById('class_id');
    const feeDropdown = document.getElementById('fees_id');

    // Get selected values from server for edit
    const selectedCenterId = "{{ old('center_id', $child->center_id ?? '') }}";
    const selectedClassId = "{{ old('class_id', $child->class_id ?? '') }}";
    const selectedFeesId = "{{ old('fees_id', $child->fees_id ?? '') }}";

    function loadClasses(centerId, selectedClassId = null) {
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
                        if (selectedClassId && cls.class_id == selectedClassId) {
                            option.selected = true;
                        }
                        classDropdown.appendChild(option);
                    });

                    // Load fees if class is already selected
                    if (selectedClassId) {
                        loadFees(centerId, selectedClassId, selectedFeesId);
                    }
                });
        }
    }

    function loadFees(centerId, classId, selectedFeesId = null) {
        feeDropdown.innerHTML = '<option value="">Select Fee</option>';

        if (centerId && classId) {
            fetch(`/get-fees-by-center-and-class/${centerId}/${classId}`)
                .then(res => res.json())
                .then(fees => {
                    fees.forEach(fee => {
                        const option = document.createElement('option');
                        option.value = fee.id;
                        option.textContent = `${fee.fees_name}`;
                        if (selectedFeesId && fee.id == selectedFeesId) {
                            option.selected = true;
                        }
                        feeDropdown.appendChild(option);
                    });
                });
        }
    }

    // When user changes center
    centerDropdown.addEventListener('change', function () {
        loadClasses(this.value);
    });

    // When user changes class
    classDropdown.addEventListener('change', function () {
        loadFees(centerDropdown.value, this.value);
    });

    // Initial load (for edit)
    if (selectedCenterId) {
        loadClasses(selectedCenterId, selectedClassId);
    }
});


//insti 



    function toggleOtherInstitution() {
        const selectedValue = document.getElementById('institution_number').value;
        const otherInstitutionDiv = document.getElementById('other_institution_div');
        if (selectedValue === 'Other') {
            otherInstitutionDiv.style.display = 'block';
        } else {
            otherInstitutionDiv.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleOtherInstitution();  // Ensure correct visibility on page load
    });


</script>





@endsection