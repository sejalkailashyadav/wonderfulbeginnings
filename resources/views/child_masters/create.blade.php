@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Create Child Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Child</li>
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

                        <form action="{{ url('child-masters') }}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="center" class="form-label">Center Name <span
                                            class="text-danger">*</span></label>
                                    <select id="center-select" name="center_id" class="form-control">
                                        <option value="">Select Center</option>
                                        @foreach($centers as $center)
                                            <option value="{{ $center->center_id }}">{{ $center->center_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3" id="program_category_field">
                                    <label for="program_category" class="form-label">Program Name <span
                                            class="text-danger">*</span></label>
                                    <select id="program-category-select" class="form-control">
                                        <option value="">Select Program </option>
                                        @foreach($programCreates as $programCreate)
                                            <option value="{{ $programCreate->program_name }}">
                                                {{ $programCreate->program_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3" id="program_field">
                                    <label for="program_id" class="form-label">Number of Days <span
                                            class="text-danger">*</span></label>
                                    <select id="program-select" name="program_id" class="form-control">
                                        <option value="">Select Program</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <!-- <label for="number_of_days" name="number_of_days" class="form-label">Number of Days
                                        <span class="text-danger">*</span></label> -->
                                    <select id="number_of_days" name="number_of_days" class="form-control" hidden>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>
                                      <label for="active_status" class="form-label">Active Status <span
                                            class="text-danger">*</span></label>
                                    <select name="active_status" class="form-control" required>
                                        <!-- <option value="">Select Status</option> -->
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="child_first_name" class="form-label">Child First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="child_first_name" class="form-control"
                                        placeholder="Enter child's first name" value="{{ old('child_first_name') }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="child_last_name" class="form-label">Child Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="child_last_name" class="form-control"
                                        value="{{ old('child_last_name') }}" placeholder="Enter child's last name" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_first_name" class="form-label">Parent First Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="parent_first_name" class="form-control"
                                        value="{{ old('parent_first_name') }}" placeholder="Enter parent's first name"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_last_name" class="form-label">Parent Last Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="parent_last_name" class="form-control"
                                        value="{{ old('parent_last_name') }}" placeholder="Enter parent's last name"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_mobile" class="form-label">Parent Mobile Number <span
                                            class="text-danger"></span></label>
                                    <input type="text" name="parent_mobile" class="form-control"
                                        value="{{ old('parent_mobile') }}" placeholder="Enter parent mobile number"
                                        >
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_email" class="form-label">Parent Email <span
                                            class="text-danger"></span></label>
                                    <input type="email" name="parent_email" class="form-control"
                                        value="{{ old('parent_email') }}" placeholder="Enter parent email" >
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="child_dob" class="form-label">Child DOB <span
                                            class="text-danger"></span></label>
                                    <input type="date" name="child_dob" value="{{ old('child_dob') }}" class="form-control"
                                        >
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="institution_number" class="form-label">Institution Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="institution_number" class="form-control"
                                        value="{{ old('institution_number') }}" placeholder="Enter institution number"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="transit_number" class="form-label">Bank Transit Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="transit_number" class="form-control"
                                        value="{{ old('transit_number') }}" placeholder="Enter transit number" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="account_number" class="form-label">Account Number <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="account_number" class="form-control"
                                        value="{{ old('account_number') }}" placeholder="Enter account number" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="emergency_contact_name" class="form-label">Emergency Contact
                                        Name</label>
                                    <input type="text" name="emergency_contact_name" class="form-control"
                                        value="{{ old('emergency_contact_name') }}"
                                        placeholder="Enter emergency contact name">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="emergency_contact_number" class="form-label">Emergency Contact
                                        Number</label>
                                    <input type="text" name="emergency_contact_number" class="form-control"
                                        value="{{ old('emergency_contact_number') }}"
                                        placeholder="Enter emergency contact number">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="admission_date" class="form-label">Admission Date <span
                                            class="text-danger"></span></label>
                                    <input type="date" name="admission_date" class="form-control"
                                        value="{{ old('admission_date') }}" >
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="registration_fees_paid" class="form-label">Registration Fees Paid <span
                                            class="text-danger"></span></label>
                                    <input type="number" name="registration_fees_paid" class="form-control"
                                        value="{{ old('registration_fees_paid') }}" placeholder="Enter registration fees">
                                </div>

                                <!-- <div class="col-md-6 mb-3">
                                  
                                </div> -->

                                <div class="col-md-6 mb-3">
                                    <label for="special_notes" class="form-label">Special Notes</label>
                                    <textarea name="special_notes" class="form-control" rows="3"
                                        placeholder="Enter any special notes"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <!-- <label for="end_date" class="form-label">End Date <span
                                                    class="text-danger" ></span></label> -->
                                    <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}"
                                        hidden>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Create Child</button>
                                <a href="{{ url('child-masters') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- <script>
        document.getElementById('center-select').addEventListener('change', function () {
            var centerId = this.value;
            var programSelect = document.getElementById('program-select');
            programSelect.innerHTML = '<option value="">-- Select Program --</option>'; // Reset programs

            if (centerId) {
                fetch('/get-programs-by-center/' + centerId)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function (program) {
                            var option = document.createElement('option');
                            option.value = program.program_id;
                            option.text = program.program_name + ' (' + program.number_of_days + ' days)';
                            option.setAttribute('data-days', program
                                .number_of_days); // Add data-days attribute
                            programSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching programs:', error);
                    });
            }
        });

        document.getElementById('program-select').addEventListener('change', function () {
            var selectedOption = this.options[this.selectedIndex];
            var days = selectedOption.getAttribute('data-days');

            if (days) {
                document.getElementById('number_of_days').value = days;
            } else {
                document.getElementById('number_of_days').value = '';
            }
        });
        
        // selct program category using prohram__name --
        const centerSelect = document.getElementById('center-select');
        const programCategorySelect = document.getElementById('program-category-select');
        const programSelect = document.getElementById('program-select');
        const numberOfDaysSelect = document.getElementById('number_of_days');

        let allPrograms = []; // will store fetched programs for the selected center

        // When center changes: fetch all programs for that center, save them locally
        centerSelect.addEventListener('change', function () {
            const centerId = this.value;
            programSelect.innerHTML = '<option value="">-- Select Program --</option>'; // Reset programs
            programCategorySelect.value = ''; // Reset category dropdown

            if (centerId) {
                fetch('/get-programs-by-center/' + centerId)
                    .then(response => response.json())
                    .then(data => {
                        allPrograms = data; // store programs fetched for this center
                    })
                    .catch(error => {
                        console.error('Error fetching programs:', error);
                    });
            } else {
                allPrograms = [];
            }
        });

        // When program category changes: filter the program dropdown
        programCategorySelect.addEventListener('change', function () {
            const selectedCategory = this.value;

            // Clear program dropdown and reset days
            programSelect.innerHTML = '<option value="">-- Select No of Days --</option>';
            numberOfDaysSelect.value = '';

            if (selectedCategory && allPrograms.length > 0) {
                // Filter programs whose program_name starts with selectedCategory
                const filteredPrograms = allPrograms.filter(program =>
                    program.program_name.startsWith(selectedCategory)
                );

                filteredPrograms.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.program_id;
                    option.text =  program.number_of_days ;
                    option.setAttribute('data-days', program.number_of_days);
                    programSelect.appendChild(option);
                });
            }
        });

        // When program changes: set number_of_days
        programSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const days = selectedOption.getAttribute('data-days');

            numberOfDaysSelect.value = days || '';
        });


    </script> -->
    <script>
        const centerSelect = document.getElementById('center-select');
const programCategorySelect = document.getElementById('program-category-select');
const programSelect = document.getElementById('program-select');
const numberOfDaysSelect = document.getElementById('number_of_days');

let allPrograms = []; // Store all programs for selected center

centerSelect.addEventListener('change', function () {
    const centerId = this.value;

    // Clear dropdowns
    programCategorySelect.innerHTML = '<option value="">-- Select Program --</option>';
    programSelect.innerHTML = '<option value="">-- Select No of Days --</option>';
    numberOfDaysSelect.value = '';
    allPrograms = [];

    if (centerId) {
        fetch('/get-programs-by-center/' + centerId)
            .then(response => response.json())
            .then(data => {
                allPrograms = data;

                // Populate unique program names into `programCategorySelect`
                const uniqueNames = [...new Set(data.map(p => p.program_name))];
                uniqueNames.forEach(name => {
                    const option = document.createElement('option');
                    option.value = name;
                    option.text = name;
                    programCategorySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching programs:', error);
            });
    }
});

programCategorySelect.addEventListener('change', function () {
    const selectedCategory = this.value;

    // Clear program dropdown
    programSelect.innerHTML = '<option value="">-- Select No of Days --</option>';
    numberOfDaysSelect.value = '';

    if (selectedCategory && allPrograms.length > 0) {
        const filteredPrograms = allPrograms.filter(program =>
            program.program_name === selectedCategory
        );

        filteredPrograms.forEach(program => {
            const option = document.createElement('option');
            option.value = program.program_id;
            option.text = program.number_of_days + ' days';
            option.setAttribute('data-days', program.number_of_days);
            programSelect.appendChild(option);
        });
    }
});

programSelect.addEventListener('change', function () {
    const selectedOption = this.options[this.selectedIndex];
    const days = selectedOption.getAttribute('data-days');
    numberOfDaysSelect.value = days || '';
});

    </script>
@endsection