@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">Create User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create User</li>
        </ol>
    </div>
    <!-- PAGE HEADER END -->

    <!-- FORM CARD -->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">User Information</h3>
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

                    <form action="{{ url('user-managements') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="user_name" class="form-label">User Name <span class="text-danger">*</span></label>
                            <input type="text" name="user_name" class="form-control" placeholder="Enter user name" required>
                        </div>
                        @error('user_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-group mb-3">
                            <label for="user_type" class="form-label">User Type <span class="text-danger">*</span></label>
                            <select name="user_type" class="form-control" required>
                                <option value="">Select type</option>
                                <option value="Admin">Admin</option>
                                <option value="Manager">Manager</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        @error('user_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!--<div class="form-group mb-3">-->
                        <!--    <label for="user_status" class="form-label">User Status <span class="text-danger">*</span></label>-->
                        <!--    <select name="user_status" class="form-control" required>-->
                        <!--        <option value="">Select status</option>-->
                        <!--        <option value="Active">Active</option>-->
                        <!--        <option value="Inactive">Inactive</option>-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!--@error('user_status')-->
                        <!--<div class="invalid-feedback">{{ $message }}</div>-->
                        <!--@enderror-->

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create User</button>
                            <a href="{{ url('user-managements') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- FORM CARD END -->

</div>
@endsection
