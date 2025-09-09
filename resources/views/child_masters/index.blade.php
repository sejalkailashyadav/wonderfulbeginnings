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
</head>

@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Child Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Child List</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- CHILD LIST CARD -->
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">All Children</h3>
                        <a href="{{ url('child-masters/create') }}" class="btn btn-primary btn-sm">+ Create New Child</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($childs->isEmpty())
                            <div class="alert alert-info">No child records found. <a
                                    href="{{ url('child-masters/create') }}">Create one</a>.</div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Active</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Parent Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <!-- <th>DOB</th> -->
                                            <th>Center Name</th>
                                            <th>Program Name</th>
                                            <th>Registration Fees Paid</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($childs as $child)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <!-- <td>{{ $child->active_status }}</td> -->
                                               <td>
                                                <input type="checkbox" class="toggle-status" data-id="{{ $child->child_id }}"
                                                    {{ $child->active_status === 'Active' ? 'checked' : '' }}>
                                            </td>
                                                <td>{{ $child->child_first_name }}</td>
                                                <td>{{ $child->child_last_name }}</td>
                                                <td>{{ $child->parent_first_name }} {{ $child->parent_last_name }}</td>
                                                <td>{{ $child->parent_email }}</td>
                                                <td>{{ $child->parent_mobile }}</td>
                                                <!-- <td>{{ $child->child_dob }}</td> -->
                                                <td>{{ $child->center->center_name ?? 'N/A'  }}</td>
                                                <td>{{ $child->program->programCreate->program_name ?? 'N/A' }}</td>
                                                <td>{{ $child->registration_fees_paid }}</td>
                                                <td class="text-center">
                                                    <!-- Edit Icon -->
                                                    <a href="{{ url('child-masters/' . $child->child_id . '/edit') }}"
                                                        class="icon-btn edit-icon" title="Edit">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                    <!-- Delete Form with Icon -->
                                                    <form action="{{ url('child-masters/' . $child->child_id) }}" method="POST"
                                                        style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="icon-btn delete-icon" title="Delete"
                                                            onclick="return confirm('Are you sure?')">
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
    <script>
    document.addEventListener('DOMContentLoaded', function () {
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
    });
</script>
@endsection 