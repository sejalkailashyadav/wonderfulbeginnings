@extends('layouts.app')

@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
            integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .icon-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 34px;
                height: 34px;
                border-radius: 50%;
                border: none;
                background-color: transparent;
                color: #6c757d;
                transition: 0.3s ease;
                font-size: 14px;
                border: 2px solid black;
            }

            .icon-btn:hover {
                background-color: #f0f0f0;
                color: #fff;
            }

            .edit-icon:hover {
                background-color: #28a745;
                color: white;
                border: 2px solid #28a745;
            }

            .delete-icon:hover {
                background-color: #dc3545;
                color: white;
                border: 2px solid #dc3545;
            }

            .icon-btn i {
                pointer-events: none;
            }
        </style>
    </head>

    <div class="container-fluid">
        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Program Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Program List</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- PROGRAM LIST CARD -->
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">All Programs</h3>
                        <a href="{{ url('program-create/create') }}" class="btn btn-primary btn-sm">+ Create New Program</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- Filter Form -->
                        <form method="GET" action="{{ url('program-masters') }}" class="mb-3">

                         <h5 style="color: #6023d5bd;">Note : select center and programs for details.</h5>   
                        <div class="row">
                           
                       
                                <div class="col-md-5">
<select id="center-select" name="center_id" class="form-control">
    <option value="">Filter by Center</option>
    @foreach($centers as $cente)
        <option value="{{ $cente->center_id }}" {{ request('center_id') == $cente->center_id ? 'selected' : '' }}>
            {{ $cente->center_name }}
        </option>
    @endforeach
</select>
</div>

<div class="col-md-5">
    <select id="program-select" name="prog_master_id" class="form-control">
        <option value="">Filter by Program</option>
    </select>
</div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                                </div>
                            </div>
                        </form>
                        @if (request()->has('center_id') || request()->has('prog_master_id'))
                            @if ($programs->isEmpty())
                                <div class="alert alert-info">No program records found. <a
                                        href="{{ url('program-create/create') }}">Create one</a>.</div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead class="table-light">
                                            <tr>
                                                <th>ID</th>
                                                <th>Center Name</th>
                                                <th>Program Name</th>
                                                <th>Number of days</th>
                                                <th>Fees</th>
                                                <th>CCFRI</th>
                                                <!-- <th>ACCB</th> -->
                                                <th>Parent Fees</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <!-- <tbody>
                                                            @foreach ($programs as $program)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>{{ $program->centers->center_name ?? 'N/A' }}</td>
                                                                    <td>{{ $program->program_name }}</td>
                                                                    <td>{{ $program->number_of_days }}</td>
                                                                    <td>${{ number_format($program->Program_Fees, 2) }}</td>
                                                                    <td>${{ number_format($program->CCFRI, 2) }}</td>

                                                                    <td>${{ number_format($program->Parent_Fees, 2) }}</td>
                                                                    <td class="text-center">

                                                                        <a href="{{ url('program-masters/' . $program->Program_id . '/edit') }}"
                                                                            class="icon-btn edit-icon" title="Edit">
                                                                            <i class="fa-solid fa-pen"></i>
                                                                        </a>


                                                                        <form action="{{ url('program-masters/' . $program->Program_id) }}"
                                                                            method="POST" style="display:inline-block;">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="icon-btn delete-icon" title="Delete"
                                                                                onclick="return confirm('Are you sure?')">
                                                                                <i class="fa-solid fa-trash"></i>
                                                                            </button>
                                                                        </form>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody> -->
                                        @foreach ($programs as $program)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $program->centers->center_name ?? 'N/A' }}</td>
                                                <td>{{ $program->programCreate->program_name ?? 'N/A' }}</td>
                                                <td>{{ $program->number_of_days }}</td>
                                                <td>${{ number_format($program->program_fees, 2) }}</td>
                                                <td>${{ number_format($program->ccfri, 2) }}</td>
                                                <td>${{ number_format($program->parent_fees, 2) }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('program-masters/' . $program->program_id . '/edit') }}"
                                                        class="icon-btn edit-icon" title="Edit">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                    <form action="{{ url('program-masters/' . $program->program_id) }}" method="POST"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="icon-btn delete-icon" title="Delete"
                                                            onclick="return confirm('Are you sure?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- <script>
document.addEventListener('DOMContentLoaded', function () {
    const centerSelect = document.getElementById('center-select');
    const programSelect = document.getElementById('program-select');

    // Load existing programs if center already selected
    if (centerSelect.value !== '') {
        fetchPrograms(centerSelect.value);
    }

    centerSelect.addEventListener('change', function () {
        fetchPrograms(this.value);
    });

    
function fetchPrograms(centerId) {
    programSelect.innerHTML = '<option value="">Loading...</option>';

    fetch('/get-programs-by-center/' + centerId)
        .then(res => res.json())
        .then(data => {
            programSelect.innerHTML = '<option value="">Select Program</option>';

            const addedNames = new Set(); // Track added program names




//             data.forEach(p => {
//     const opt = document.createElement('option');
//     opt.value = p.prog_master_id; 
//     opt.textContent = p.program_name + ' - ' + p.number_of_days + ' Days'; // Optional: to show days also
//     if ({{ json_encode(request('prog_master_id')) }} == p.prog_master_id) {
//         opt.selected = true;
//     }
//     programSelect.appendChild(opt);
// });


            data.forEach(p => {
                if (!addedNames.has(p.program_name)) {
                    addedNames.add(p.program_name); // Mark this name as added

                    const opt = document.createElement('option');
                    opt.value = p.prog_master_id; // or use p.prog_master_id if needed
                    opt.textContent = p.program_name;

                    if ({{ json_encode(request('prog_master_id')) }} == p.prog_master_id) {
                        opt.selected = true;
                    }

                    programSelect.appendChild(opt);
                }
            });
        })
        .catch(err => {
            programSelect.innerHTML = '<option value="">Error loading</option>';
            console.error(err);
        });
}

});
</script> -->


<script>
document.addEventListener('DOMContentLoaded', function () {
    const centerSelect = document.getElementById('center-select');
    const programSelect = document.getElementById('program-select');

    // Load if center already selected
    if (centerSelect.value !== '') {
        fetchPrograms(centerSelect.value);
    }

    centerSelect.addEventListener('change', function () {
        fetchPrograms(this.value);
    });

    function fetchPrograms(centerId) {
        programSelect.innerHTML = '<option value="">Loading...</option>';

        fetch('/get-programs-by-center/' + centerId)
            .then(res => res.json())
            .then(data => {
                programSelect.innerHTML = '<option value="">Select Program</option>';

                data.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.prog_master_id;  // using prog_master_id
                    opt.textContent = p.program_name;

                    // Select if already filtered
                    if ({{ json_encode(request('prog_master_id')) }} == p.prog_master_id) {
                        opt.selected = true;
                    }

                    programSelect.appendChild(opt);
                });
            })
            .catch(err => {
                programSelect.innerHTML = '<option value="">Error loading</option>';
                console.error(err);
            });
    }
});
</script>

