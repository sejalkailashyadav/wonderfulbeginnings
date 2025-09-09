<head>
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

        .toggle-status {
            width: 40px;
            height: 20px;
            cursor: pointer;
        }

        input[type="checkbox"] {
            width: 1em;
            height: 1rem;
            accent-color: green;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@extends('layouts.app')
@section('content')

<form method="GET" action="{{ url()->current() }}">
    @csrf
    @php $user = session('user'); @endphp

    @if($user->user_type === 'Admin')

    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title"> Child Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Child
                    List</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- CHILD LIST CARD -->
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">All Children</h3>
                        <!--<a href="{{ url('current-child-masters/create') }}" class="btn btn-primary btn-sm">+ Create New-->
                        <!--    Child</a>-->
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success')
                            }}</div>
                        @endif

                        @if ($childs->isEmpty())
                        <div class="alert alert-info">No child records found. <a
                                href="{{ url('child-masters/create') }}">Create
                                one</a>.</div>
                        @else

                        {{-- ADMIN FILTERS: Center → Class → Fee → Status --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label">Center</label>
                                <select id="center_id" name="center_id" class="form-control">
                                    <option value="">Select Center</option>
                                    @foreach($centers as $center)
                                    <option value="{{ $center->center_id }}" {{ request('center_id')==$center->center_id
                                        ? 'selected' : '' }}>
                                        {{ $center->center_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Class</label>
                                <select id="class_id" name="class_id" class="form-control">
                                    <option value="">Select Class</option>
                                </select>
                            </div>

                            <div  style="display:none">
                                <label class="form-label" >Fee</label>
                                <select id="fees_id" name="fees_id" class="form-control">
                                    <option value="">Select Fee</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="1" {{ request('status')=='1' ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ request('status')=='2' ? 'selected' : '' }}>Withdrawn</option>
                                </select>
                                </div>
                             <div class="col-md-3 pt-5">    
                                  <button type="submit" class="btn btn-primary">Apply Filters</button>
                                  <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                            </div>
                           
                        </div>


                      

                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Child Name</th>
                                    <th>Parent Name</th>
                                    <th>Parent Mobile</th>
                                    <th>Class</th>
                                    <th>Fees</th>
                                    <TH>Days</TH>
                                    <th>status</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody id="child-table-body">
                                @include('current_child_masters.partials.child-table',
                                ['childs' => $childs])
                            </tbody>

                        </table>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    </div>
    @else
    <input type="hidden" name="center_id" value="{{ $user->center_id }}">
    <input type="hidden" id="filter-center" value="{{ $user->center_id }}">
    <input type="hidden" id="search-name">
    <input type="hidden" id="filter-fees">

    <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">Child Master</h1>
        </div>
        <br> <br> <br> <br> <br> <br>

        @if (session('user')->user_type === 'Manager')
        {{-- MANAGER FILTERS: fixed center (hidden) → Class → Fee → Status --}}
        <input type="hidden" id="center_id" name="center_id" value="{{ $user->center_id }}">

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <label class="form-label">Class</label>
                <select id="class_id" name="class_id" class="form-control">
                    <option value="">Select Class</option>
                </select>
            </div>

           

            <div class="col-md-3">
                <label class="form-label">Status</label>
                <select id="status" name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="1" {{ request('status')=='1' ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ request('status')=='2' ? 'selected' : '' }}>Withdrawn</option>
                </select>
            </div>
             <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
             </div>
              <div class="col-md-3" style="display:none">
                <label class="form-label">Fee</label>
                <select id="fees_id" name="fees_id" class="form-control">
                    <option value="">Select Fee</option>
                </select>
            </div>
        </div>
       
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Children for Center: {{ $user->center->center_name }}</h3>
                    </div>

                    <div class="card-body">
                        <!-- Hidden filters for JS to use -->
                        <input type="hidden" id="filter-center" value="{{ $user->center_id }}">
                        <input type="hidden" id="search-name">
                        <input type="hidden" id="filter-fees">


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Child Name</th>
                                        <th>Parent Name</th>

                                        <th>Parent Mobile</th>

                                        <th>Class</th>
                                        <th>Fees</th>
                                        <th>Days</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody id="child-table-body">
                                    @include('current_child_masters.partials.child-table', ['childs' => $childs])
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const centerDropdown = document.getElementById('center_id');
        const classDropdown = document.getElementById('class_id');
        const feeDropdown = document.getElementById('fees_id');

        function resetClasses() {
            classDropdown.innerHTML = '<option value="">Select Class</option>';
        }
        function resetFees() {
            feeDropdown.innerHTML = '<option value="">Select Fee</option>';
        }

        function loadClasses(centerId) {
            resetClasses(); resetFees();
            if (!centerId) return;

            fetch(`/get-classes-by-center/${centerId}`)
                .then(res => res.json())
                .then(classes => {
                    classes.forEach(cls => {
                        const opt = document.createElement('option');
                        opt.value = cls.class_id;
                        opt.textContent = cls.class_name;
                        classDropdown.appendChild(opt);
                    });
                })
                .catch(err => console.error('Error fetching classes:', err));
        }

        function loadFees(centerId, classId) {
            resetFees();
            if (!centerId || !classId) return;

            fetch(`/get-fees-by-center-and-class/${centerId}/${classId}`)
                .then(res => res.json())
                .then(fees => {
                    fees.forEach(fee => {
                        const opt = document.createElement('option');
                        opt.value = fee.id;
                        opt.textContent = fee.fees_name;
                        feeDropdown.appendChild(opt);
                    });
                })
                .catch(err => console.error('Error fetching fees:', err));
        }

        // Admin: react to center changes; Manager: center is hidden, so just load using its value
        if (centerDropdown &&  centerDropdown.tagName === 'SELECT') {
            centerDropdown.addEventListener('change', function () {
                loadClasses(this.value);
            });
        }
        // Initial population (covers both Admin with preselected center, and Manager with hidden center)
        if (centerDropdown && centerDropdown.value) {
            loadClasses(centerDropdown.value);
        }

        classDropdown.addEventListener('change', function () {
            loadFees(centerDropdown.value, this.value);
        });
    });

    // Toggle status logic
    document.querySelectorAll('.toggle-status').forEach(function (toggle) {
        toggle.addEventListener('change', function () {
            const childId = this.getAttribute('data-id');
            const newStatus = this.checked ? 'Active' : 'Inactive';

            fetch(`/child-masters/${childId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: newStatus })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        console.log(`Status updated to ${newStatus}`);
                    } else {
                        alert('Update failed');
                    }
                });
        });
    });

</script>
@endsection