@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">Assign Fees to Program</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Assign Program</li>
        </ol>
    </div>
    <!-- PAGE HEADER END -->

    <!-- FORM CARD -->
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Program Information</h3>
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

                    <form action="{{ url('program-masters') }}" method="POST">
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
                       
                                <label for="Program_Fees" class="form-label">Program Fees <span class="text-danger">*</span></label>
                                <input type="number" name="program_fees" class="form-control"   value="{{ old('program_fees') }}"  placeholder="Enter total program fees" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="CCFRI" class="form-label">CCFRI <span class="text-danger">*</span></label>
                                <input type="number" name="ccfri" class="form-control" value="{{ old('ccfri') }}"   placeholder="Enter CCFRI value" >
                            </div>

                            <div class="col-md-6 mb-3">
                                <!-- <label for="ACCB" class="form-label">ACCB</label> -->
                                <input type="number" name="accb" class="form-control" value="{{ old('accb') }}"   placeholder="Enter ACCB value" hidden>
                            </div>

                            <div class="col-md-6 mb-3">
                                <!-- <label for="Parent_Fees" class="form-label">Parent Fees <span class="text-danger">*</span></label> -->
                                <input type="number" name="parent_fees" class="form-control"  value="{{ old('parent_fees') }}"  placeholder="Enter parent fee" hidden>
                            </div>

                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Program</button>
                            <a href="{{ url('program-masters') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                    <!-- JQuery and AJAX -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                  

                </div>
            </div>
        </div>
    </div>
</div>
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
