 @extends('layouts.app')

            @section('content')
            <div class="container">
                <!-- PAGE HEADER -->
                <div
                    class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
                    style="position: relative; z-index: 5;">
                    <h1 class="h4 text-black fw-bold mb-0">Waiting Employee
                        Details</h1>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a
                                href="{{ url('/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">Waiting Employee Details</li>
                    </ol>
                </div>

                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('employee_masters.index') }}"
                        class="btn btn-secondary">← Back to List</a>
                </div>

                <!-- Employee Details Card -->
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <strong>Employee Name :</strong>
                            <p>{{ $employee->first_name }} {{
                                $employee->last_name }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>Mobile Number:</strong>
                            <p>{{ $employee->mobile_number }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>Email:</strong>
                            <p>{{ $employee->email }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>Reference:</strong>
                            <p>{{ $employee->reference }}</p>
                        </div>
    
                        <div class="col-md-3 mb-3">
                            <strong>Expected Start Date: </strong>
                            <p>{{ $employee->expected_start_date }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <strong>Resume:</strong><br>
                            @if($employee->resume)
                            <a href="{{ asset($employee->resume) }}"
                                target="_blank"
                                class="btn btn-sm btn-info">View</a>
                            @else
                            <p>N/A</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
 @endsection
