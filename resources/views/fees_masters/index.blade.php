<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
     <script>
    const accountMap = @json($accountMap);
    console.log("huihuih",accountMap);
    
</script>
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
            /* default gray */
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
            /* green */
            color: white;
            border: 2px solid #28a745;
        }

        .delete-icon:hover {
            background-color: #dc3545;
            /* red */
            color: white;
            border: 2px solid #dc3545;
        }

        .icon-btn i {
            pointer-events: none;
            /* prevents double click on icon */
        }
    </style>
</head>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if(session('center_id'))
            <div class="mt-2 mb-3">
                <strong>Showing report for: </strong>
                {{ $centers->firstWhere('center_id', session('center_id'))?->center_name ?? 'Unknown Center' }}
            </div>
        @endif

        <div class="page-header">
            <h1 class="page-title">Reports Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reports List</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="card-title mb-1">Create Monthly Report</h2>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($fees->isEmpty())
                            <div class="alert alert-info">No Reports records found. <a
                                    href="{{ url('fees-masters/create') }}">Create one</a>.</div>
                        @else
                            <form method="POST" action="{{ route('fees-masters.store') }}">
                                @csrf
                                <div class="row">
                                <h5 style="color: #6023d5bd;margin-left:20px;margin-bottom:20px">Note :filter above data to create report.</h5>  <br><br>  <br>
                                    <div class="col-md-2">
                                        <label for="month_year"><b>Month-Year</b></label>
                                        <input type="month" name="month_year"  id ="month_id" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="report_name"><b>Enter report name</b></label>
                                        <input type="text" name="report_name" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="center_id"><b>Select Center</b></label>
                                        <select name="center_id" class="form-control" required>
                                            <option value="">Select Center</option>
                                            @foreach($centers as $center)

                                                <option value="{{ $center->center_id }}">{{ $center->center_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 align-self-end">
                                        <button type="submit" class="btn btn-primary">Submit monthly report</button>
                                    </div>
                                </div>
                            </form>


                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Center Name</th>
                                            <th>Program Name</th>
                                            <th>Child Name</th>
                                            <th>Parent Name</th>
                                            <th>Child DOB</th>
                                            <th>No. of Days</th>
                                            <th>Total Fees</th>
                                            <th>CCFRI</th>
                                            <th>ACCB</th>
                                            <th>Status</th>
                                            <th>Parent Fees</th>
                                            <th>Admission Date  </th>
                                            <th>Institution Number </th>
                                            <th>Transit Number</th>
                                            <th>Account Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="center-data-table-body">
                                        <!-- JS will load data here -->
                                    </tbody>

                                    <!-- <tbody>
                                                @foreach ($fees as $index => $fee)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $fee->center_name }}</td>
                                                    <td>{{ $fee->program_name }}</td>
                                                    <td>{{ $fee->child_first_name }} {{ $fee->child_last_name }}</td>
                                                    <td>{{ $fee->parent_first_name }} {{ $fee->parent_last_name }}</td>
                                                    <td>{{ $fee->child_dob }}</td>
                                                    <td>{{ $fee->number_of_days }}</td>
                                                    <td>{{ $fee->program_fees }}</td>
                                                    <td>{{ $fee->ccfri }}</td>
                                                    <td>{{ $fee->accb }}</td>
                                                    <td>{{ $fee->parent_fees }}</td>
                                                    <td>{{ $fee->institution_number }}</td>
                                                    <td>{{ $fee->transit_number }}</td>
                                                    <td>{{ $fee->account_number }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody> -->
                                </table>
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <script>
        document.querySelector('select[name="center_id"]').addEventListener('change', function () {
            let centerId = this.value;

            if (!centerId) return;

            fetch(`/get-center-report-data/${centerId}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.querySelector('#center-data-table-body');
                    if (!tableBody) return;

                    tableBody.innerHTML = '';

                    data.forEach((item, index) => {
                        tableBody.innerHTML += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.center_name}</td>
                                    <td>${item.program_name}</td>
                                    <td>${item.child_first_name} ${item.child_last_name}</td>
                                    <td>${item.parent_first_name} ${item.parent_last_name}</td>
                                    <td>${item.child_dob}</td>
                                    <td>${item.number_of_days}</td>
                                    <td>${item.program_fees}</td>
                                    <td>${item.ccfri}</td>
                                    <td>${item.accb}</td>
                                    <td>${item.parent_fees}</td>
                                    <td>${item.institution_number}</td>
                                    <td>${item.transit_number}</td>
                                    <td>${item.account_number}</td>
                                </tr>
                            `;
                    });
                });
        });
    </script> -->
    
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Load all data by default
        fetch(`/get-center-report-data`)
            .then(response => response.json())
            .then(data => populateTable(data));
    });

    // document.querySelector('select[name="center_id"]').addEventListener('change', function () {
    //     let centerId = this.value;
    //     if (!centerId) return;

    //     fetch(`/get-center-report-data/${centerId}`)
    //         .then(response => response.json())
    //         .then(data => populateTable(data));
    // });

    //for month also  id i month_id

document.querySelector('select[name="center_id"]').addEventListener('change', function () {
    let centerId = this.value;
    let month = document.querySelector('input[name="month_year"]').value;

    if (!centerId || !month) return;

    fetch(`/get-center-report-data?centerId=${centerId}&month=${month}`)
        .then(response => response.json())
        .then(data => populateTable(data));
});


document.querySelector('input[name="month_year"]').addEventListener('change', function () {
    let month = this.value;
    let centerId = document.querySelector('select[name="center_id"]').value;

    if (!centerId || !month) return;

    fetch(`/get-center-report-data?centerId=${centerId}&month=${month}`)
        .then(response => response.json())
        .then(data => populateTable(data));
});




function populateTable(data) {
    let tableBody = document.querySelector('#center-data-table-body');
    if (!tableBody) return;
    tableBody.innerHTML = '';

    data.forEach((item, index) => {
        tableBody.innerHTML += `
            <tr>
                <td>${index + 1}</td>
                <td>${item.center_name}</td>
                <td>${item.program_name}</td>
                <td>${item.child_first_name} ${item.child_last_name}</td>
                <td>${item.parent_first_name} ${item.parent_last_name}</td>
                <td>${item.child_dob}</td>
                <td>${item.number_of_days}</td>
                <td>${item.program_fees}</td>
                <td>${item.ccfri}</td>
                <td>${item.accb}</td>
                <td>${item.active_status}</td>
                <td>${item.parent_fees}</td>
                <td>${item.admission_date}</td>
                <td>${item.institution_number}</td>
                <td>${item.transit_number}</td>
                <td>${item.account_number}</td>
                <td><a href="javascript:void(0);" class="account-link" data-account="${item.account_number}">
                  Edit child details
                </a></td>
            </tr>
        `;
    });

    // Now attach click listeners to all newly created links
    document.querySelectorAll('.account-link').forEach(link => {
        link.addEventListener('click', function () {
            const account = this.dataset.account;
            const childId = accountMap[account];
            if (childId) {
                window.location.href = `/child-masters/${childId}/edit`;
            } else {
                alert("Child ID not found for this Account Number.");
            }
        });
    });
}
    // function populateTable(data) {
    //     let tableBody = document.querySelector('#center-data-table-body');
    //     if (!tableBody) return;
    //     tableBody.innerHTML = '';

    //     data.forEach((item, index) => {
    //         tableBody.innerHTML += `
    //             <tr>
    //                 <td>${index + 1}</td>
    //                 <td>${item.center_name}</td>
    //                 <td>${item.program_name}</td>
    //                 <td>${item.child_first_name} ${item.child_last_name}</td>
    //                 <td>${item.parent_first_name} ${item.parent_last_name}</td>
    //                 <td>${item.child_dob}</td>
    //                 <td>${item.number_of_days}</td>
    //                 <td>${item.program_fees}</td>
    //                 <td>${item.ccfri}</td>
    //                 <td>${item.accb}</td>
    //                  <td>${item.active_status}</td>
    //                 <td>${item.parent_fees}</td>
    //                  <td>${item.admission_date}</td>
    //                 <td>${item.institution_number}</td>
    //                 <td>${item.transit_number}</td>
    //                <td>${item.account_number}</td>
    //             </tr>
    //         `;
    //     });
    // }
</script>

@endsection