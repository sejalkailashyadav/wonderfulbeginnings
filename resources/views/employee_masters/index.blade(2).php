
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee List</h2>
    <a href="{{ route('employee_masters.create') }}" class="btn btn-primary mb-3">Add New Employee</a>

    <table class="table">
        <thead>
            <tr>
                <th>Employee Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
                <tr>
                    <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
                    <td>
                        <a href="{{ route('employee_masters.show', $emp->emp_id) }}" class="btn btn-sm btn-info">View</a>
                   
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





