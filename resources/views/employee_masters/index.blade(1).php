@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee List</h2>
    <a href="{{ route('employee_masters.create') }}" class="btn btn-primary">Add New Employee</a>
    <table class="table mt-3">
        <thead>
            <tr>
            <th>Name</th>
            <th>Mobile </th>
            <th>Email ddress</th>
            <th>Resume</th>
            <th>Designation</th>
            <th>ECE License Upload</th>
            <th>ECE License Expiry Date</th>
            <th>Primary Working Location</th>
            <th> License</th>
            <th>License Expiry </th>
            <th>Police </th>
            <th>Police Expiry Date</th>
            <th>Immunization Record</th>
            <th>COVID 19 Records</th>
            <th>Start Date</th>
            <th>Probation End </th>
            <th>Reference Letter</th>
            <th>Signed Handbook </th>
            <th>Income-Tax Forms</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
                <tr>
                <td>{{ $emp->first_name}} {{ $emp->last_name}}</td>
                <td>{{ $emp->mobile_number}}</td>
                <td>{{ $emp->email}}</td>
                <td>
                    @if($emp->resume)
                        <a href="{{ asset($emp->resume) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                    @else
                        N/A
                    @endif
                </td>
               <td>{{ $emp->designation }}</td>
                    <td>
                        @if($emp->ece_license)
                            <a href="{{ asset($emp->ece_license) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $emp->ece_license_expiry }}</td>
                    <td>{{ $emp->primary_location }}</td>
                    <td>
                        @if($emp->first_aid_license)
                            <a href="{{ asset($emp->first_aid_license) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $emp->first_aid_expiry }}</td>
                    <td>
                        @if($emp->police_clearance)
                            <a href="{{ asset($emp->police_clearance) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $emp->police_clearance_expiry }}</td>
                    <td>
                        @if($emp->immunization_record)
                            <a href="{{ asset($emp->immunization_record) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($emp->covid_vaccine_record)
                            <a href="{{ asset($emp->covid_vaccine_record) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $emp->start_date }}</td>
                    <td>{{ $emp->probation_end_period }}</td>
                    <td>
                        @if($emp->three_reference_letter)
                            <a href="{{ asset($emp->three_reference_letter) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($emp->signed_handbook)
                            <a href="{{ asset($emp->signed_handbook) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($emp->income_tax_forms)
                            <a href="{{ asset($emp->income_tax_forms) }}" target="_blank" class="btn btn-sm btn-info">View</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('employee_masters.edit', $emp->emp_id) }}" class="btn btn-sm btn-warning">Edit</a>
                        
                        <form action="{{ route('employee_masters.destroy', $emp->emp_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

