@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-4">
  <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="position: relative; z-index: 5;">
        <h1 class="h4 text-black fw-bold mb-0">Employee List</h1>
        <!--<ol class="breadcrumb mb-0">-->
        <!--    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>-->
        <!--    <li class="breadcrumb-item active" aria-current="page">Employee</li>-->
        <!--</ol>-->
    </div>
        <a href="{{ route('employee_masters.create') }}" class="btn btn-primary">
            + Add New Employee
        </a>
    </div>

    <!-- Employee Table Card -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
  <h5>
  <a href="#" 
     onclick="navigator.clipboard.writeText('https://shorturl.at/v3EPa'); alert('Link copied to clipboard!'); return false;" 
     style="text-decoration:none; display:flex; align-items:center; gap:6px;color:blue">
     
    Public Link 
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
      <path d="M10 1.5v1h1.5A1.5 1.5 0 0 1 13 4v9a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 13V4a1.5 1.5 0 0 1 1.5-1.5H6v-1A1.5 1.5 0 0 1 7.5 0h1A1.5 1.5 0 0 1 10 1.5zM6 2.5v-1h4v1H6z"/>
    </svg>
  </a>
</h5>


                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Employee Name</th>
                            <th scope="col" class="text-center" style="width: 220px;">Action</th><h5>

</h5>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $emp)
                            <tr>
                                <td>{{ $emp->first_name }} {{ $emp->last_name }}</td>
<td class="text-center">
    <div class="d-flex justify-content-center flex-wrap gap-2">
        <a href="{{ route('employee_masters.show', $emp->emp_id) }}"
           class="btn btn-sm btn-info">
            View
        </a>

        <a href="{{ route('employee_masters.edit', $emp->emp_id) }}"
           class="btn btn-sm btn-warning">
            Edit
        </a>

        <form action="{{ route('employee_masters.destroy', $emp->emp_id) }}"
              method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="btn btn-sm btn-danger"
                    onclick="return confirm('Are you sure?')">
                Delete
            </button>
        </form>
    </div>
</td>

                            </tr>
                        @endforeach

                        @if($employees->isEmpty())
                            <tr>
                                <td colspan="2" class="text-center text-muted">No employees found.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
