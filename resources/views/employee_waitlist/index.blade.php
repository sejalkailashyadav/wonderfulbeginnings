@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
  <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="position: relative; z-index: 5;">
        <h1 class="h4 text-black fw-bold mb-0"> Employee Waiting List</h1>
    </div>
        <a href="{{ route('employee_waitlist.create') }}" class="btn btn-primary">
            + Add Waiting Employee
        </a>
    </div>

    <!-- Employee Table Card -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
        <thead class="table-light">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $index => $employee)
            <tr>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                
                <td>
                        <a href="{{ route('employee_waitlist.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('employee_waitlist.destroy', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                   <a href="{{ route('employee_waitlist.show', $employee->id) }}" class="btn btn-sm btn-info"> View</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="10" class="text-center">No employee entries found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div></div></div>
</div>
@endsection