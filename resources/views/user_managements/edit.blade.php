@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">Edit User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('user-managements') }}">User List</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </div>
    <!-- PAGE HEADER END -->

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-header">
                    <h3 class="card-title">Update User Details</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('user-managements/' . $user->user_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- User Name -->
                        <div class="form-group">
                            <label for="user_name">User Name <span class="text-danger">*</span></label>
                            <input type="text" name="user_name" id="user_name" class="form-control" value="{{ old('user_name', $user->user_name) }}" required>
                        </div>

                       <!-- User Type -->
<div class="form-group mb-3">
    <label>Select User Type <span class="text-danger">*</span></label>
    <select name="user_type" class="form-control" required>
        <option value="">Select User Type</option>
        <option value="Admin" {{ $user->user_type == 'Admin' ? 'selected' : '' }}>Admin</option>
        <option value="Manager" {{ $user->user_type == 'Manager' ? 'selected' : '' }}>Manager</option>
        <option value="Staff" {{ $user->user_type == 'Staff' ? 'selected' : '' }}>Staff</option>
    </select>
</div>

<!-- User Status -->
<div class="form-group mb-3">
    <label>Select Status <span class="text-danger">*</span></label>
    <select name="user_status" class="form-control" required>
        <option value="">Select Status</option>
        <option value="Active" {{ $user->user_status == 'Active' ? 'selected' : '' }}>Active</option>
        <option value="Inactive" {{ $user->user_status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>



                        <!-- Submit Button -->
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success">Update User</button>
                            <a href="{{ url('user-managements') }}" class="btn btn-secondary">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
