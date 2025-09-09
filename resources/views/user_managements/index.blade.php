<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">User Management</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">User List</li>
        </ol>
    </div>
    <!-- PAGE HEADER END -->

    <!-- USER LIST CARD -->
    <div class="row">
        <div class="col-md-12">
            <div class="card custom-card shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">All Users</h3>
                    <a href="{{ url('user-managements/create') }}" class="btn btn-primary btn-sm">+ Create New User</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($users->isEmpty())
                        <div class="alert alert-info">No user records found. <a href="{{ url('user-managements/create') }}">Create one</a>.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>USER NAME</th>
                                        <th>USER TYPE</th>
                                        <th>USER STATUS</th>
                                        <th>CREATED AT</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->user_name }}</td>
                                            <td>{{ $user->user_type }}</td>
                                            <td>{{ $user->user_status }}</td>
                                           
                                            <td class="text-center">
                                                <!-- Edit Icon -->
                                                <a href="{{ url('user-managements/' . $user->user_id  . '/edit') }}" class="icon-btn edit-icon" title="Edit">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>

                                                <!-- Delete Form with Icon -->
                                                <form action="{{ url('user-managements/' . $user->user_id ) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="icon-btn delete-icon" title="Delete" onclick="return confirm('Are you sure?')">
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

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
