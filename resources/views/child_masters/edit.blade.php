@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Edit Child Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Child</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- FORM CARD -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">Child Information</h3>
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

                        <form action="{{ url('child-masters/' . $child->child_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="center-select" class="form-label">Center Name <span
                                            class="text-danger">*</span></label>
                                    <select name="center_id" id="center-select" class="form-control" required>
                                        <option value="">Select Center</option>
                                        @foreach ($centers as $center)
                                            <option value="{{ $center->center_id }}" {{ $child->center_id == $center->center_id ? 'selected' : '' }}>
                                                {{ $center->center_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="program-select" class="form-label">Program Name <span
                                            class="text-danger">*</span></label>
                                    <select name="program_id" id="program-select" class="form-control" required>
                                        <option value="">Select Program</option>
                                        {{-- Options will be dynamically loaded via JS --}}
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="number_of_days" class="form-label">Number of Days <span
                                            class="text-danger">*</span></label>
                                    <select id="number_of_days" name="number_of_days" class="form-control" required>
                                        <option value="1" {{ $child->number_of_days == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $child->number_of_days == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $child->number_of_days == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $child->number_of_days == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $child->number_of_days == 5 ? 'selected' : '' }}>5</option>
                                        <option value="6" {{ $child->number_of_days == 6 ? 'selected' : '' }}>6</option>
                                        <option value="7" {{ $child->number_of_days == 7 ? 'selected' : '' }}>7</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="child_first_name" class="form-label">Child First Name</label>
                                    <input type="text" name="child_first_name" class="form-control"
                                        value="{{ $child->child_first_name }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="child_last_name" class="form-label">Child Last Name</label>
                                    <input type="text" name="child_last_name" class="form-control"
                                        value="{{ $child->child_last_name }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_first_name" class="form-label">Parent First Name</label>
                                    <input type="text" name="parent_first_name" class="form-control"
                                        value="{{ $child->parent_first_name }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_last_name" class="form-label">Parent Last Name</label>
                                    <input type="text" name="parent_last_name" class="form-control"
                                        value="{{ $child->parent_last_name }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_mobile" class="form-label">Parent Mobile Number</label>
                                    <input type="text" name="parent_mobile" class="form-control"
                                        value="{{ $child->parent_mobile }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_email" class="form-label">Parent Email</label>
                                    <input type="email" name="parent_email" class="form-control"
                                        value="{{ $child->parent_email }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="child_dob" class="form-label">Child DOB</label>
                                    <input type="date" name="child_dob" class="form-control" value="{{ $child->child_dob }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="institution_number" class="form-label">Institution Number</label>
                                    <input type="text" name="institution_number" class="form-control"
                                        value="{{ $child->institution_number }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="transit_number" class="form-label">Bank Transit Number</label>
                                    <input type="text" name="transit_number" class="form-control"
                                        value="{{ $child->transit_number }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="text" name="account_number" class="form-control"
                                        value="{{ $child->account_number }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="Child_Emergency_Contact_Name" class="form-label">Emergency Contact
                                        Name</label>
                                    <input type="text" name="Child_Emergency_Contact_Name" class="form-control"
                                        value="{{ $child->Child_Emergency_Contact_Name }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="emergency_contact_name" class="form-label">Emergency Contact Number</label>
                                    <input type="text" name="emergency_contact_name" class="form-control"
                                        value="{{ $child->emergency_contact_name }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="admission_date" class="form-label">Admission Date</label>
                                    <input type="date" name="admission_date" class="form-control"
                                        value="{{ $child->admission_date }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ $child->end_date }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="registration_fees_paid" class="form-label">Registration Fees Paid</label>
                                    <input type="number" name="registration_fees_paid" class="form-control"
                                        value="{{ $child->registration_fees_paid }}" >
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="active_status" class="form-label">Active Status</label>
                                    <select name="active_status" class="form-control" required>
                                        <option value="">Select Status</option>
                                        <option value="Active" {{ $child->active_status == 'Active' ? 'selected' : '' }}>
                                            Active</option>
                                        <option value="Inactive" {{ $child->active_status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="special_notes" class="form-label">Special Notes</label>
                                    <textarea name="special_notes" class="form-control"
                                        rows="3">{{ $child->special_notes }}</textarea>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Update Child</button>
                                <a href="{{ url('child-masters') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const centerSelect = document.getElementById('center-select');
        const programSelect = document.getElementById('program-select');
        const numberOfDaysSelect = document.getElementById('number_of_days');

        // Populate program list on center change
        centerSelect.addEventListener('change', function () {
            const centerId = this.value;
            programSelect.innerHTML = '<option value="">Select Program</option>';
            numberOfDaysSelect.value = '';

            if (centerId) {
                fetch('/get-programs-by-center/' + centerId)
                    .then(response => response.json())
                    // .then(data => {
                    //     data.forEach(program => {
                    //         const option = document.createElement('option');
                    //         option.value = program.program_id;
                    //         option.text = `${program.program_name}`;
                    //         option.setAttribute('data-days', program.number_of_days);
                    //         programSelect.appendChild(option);
                    //     });

                    //     // Auto-select current program if available
                    //     const currentProgramId = "{{ $child->program_id }}";
                    //     if (currentProgramId) {
                    //         programSelect.value = currentProgramId;

                    //         // Also auto-set number_of_days
                    //         const selectedOption = programSelect.querySelector(
                    //             `option[value="${currentProgramId}"]`);
                    //         if (selectedOption) {
                    //             numberOfDaysSelect.value = selectedOption.getAttribute('data-days');
                    //         }
                    //     }
                    // });


                    //not syore prohram that is uniqhye 
                    // .then(data => {
                    //     const seenProgramNames = new Set(); // to track unique program names
                    //     data.forEach(program => {
                    //         if (!seenProgramNames.has(program.program_name)) {
                    //             seenProgramNames.add(program.program_name);

                    //             const option = document.createElement('option');
                    //             option.value = program.program_id;
                    //             option.text = `${program.program_name}`;
                    //             option.setAttribute('data-days', program.number_of_days);
                    //             programSelect.appendChild(option);
                    //         }
                    //     });

                    //     // Auto-select current program if available
                    //     const currentProgramId = "{{ $child->program_id }}";
                    //     if (currentProgramId) {
                    //         programSelect.value = currentProgramId;

                    //         // Also auto-set number_of_days
                    //         const selectedOption = programSelect.querySelector(
                    //             `option[value="${currentProgramId}"]`);
                    //         if (selectedOption) {
                    //             numberOfDaysSelect.value = selectedOption.getAttribute('data-days');
                    //         }
                    //     }
                    // });

                    //storfe that uniquye prigram that haes unqiye vaue --

                    .then(data => {
                        const seenProgramNames = new Set(); // track unique names
                        const currentProgramId = "{{ $child->program_id }}";

                        data.forEach(program => {
                            const isCurrentProgram = program.program_id == currentProgramId;

                            if (!seenProgramNames.has(program.program_name) || isCurrentProgram) {
                                if (!isCurrentProgram) {
                                    seenProgramNames.add(program.program_name);
                                }

                                const option = document.createElement('option');
                                option.value = program.program_id;
                                option.text = `${program.program_name}`;
                                option.setAttribute('data-days', program.number_of_days);
                                programSelect.appendChild(option);
                            }
                        });

                        // Auto-select current program
                        if (currentProgramId) {
                            programSelect.value = currentProgramId;

                            // Set number_of_days
                            const selectedOption = programSelect.querySelector(
                                `option[value="${currentProgramId}"]`
                            );
                            if (selectedOption) {
                                numberOfDaysSelect.value = selectedOption.getAttribute('data-days');
                            }
                        }
                    });

            }
        });

        // Auto-set number_of_days on program select
        programSelect.addEventListener('change', function () {
            const selected = this.options[this.selectedIndex];
            const days = selected.getAttribute('data-days');
            numberOfDaysSelect.value = days ?? '';
        });

        // Auto-trigger on page load to populate program list
        window.addEventListener('load', function () {
            if (centerSelect.value) {
                const event = new Event('change');
                centerSelect.dispatchEvent(event);
            }
        });
    </script>
@endsection