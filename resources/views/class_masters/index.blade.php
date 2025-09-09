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

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Class Management</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Center List</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- CENTER LIST CARD -->
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">All Centers</h3>
                        <!--<a href="{{ url('center-managements/create') }}" class="btn btn-primary btn-sm">+ Create New-->
                        <!--    Center</a>-->
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
@php $user = session('user'); @endphp
                        @if ($class->isEmpty())
                            <div class="alert alert-info">No centers found. <a
                                    href="{{ url('center-managements/create') }}">Create one</a>.</div>
                        @else
                            <div class="table-responsive">
                 @if($user->user_type === 'Admin')                                     
                     <form method="GET" action="{{ route('class-masters.index') }}"  id="filterForm" class="row g-2 mb-4">
                                <!-- Center Dropdown -->
                                <div class="col-md-4">
                                    <select id="center_id" name="center_id" class="form-control">
                                        <option value="">-- Select Center --</option>
                                        @foreach($centers as $center)
                                            <option value="{{ $center->center_id }}" 
                                                {{ request('center_id') == $center->center_id ? 'selected' : '' }}>
                                                {{ $center->center_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                     <button type="button"  class="btn btn-primary" id="resetBtns">
                                             Reset
                                            </button>
                                </div>
                                
                            </form> @endif
                                <table class="table table-bordered table-hover text-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <!--<th>Center </th>-->
                                            <th>Class </th>
                                            <th>Amount</th>
                                            <th>Schedules Doc</th>
                                            <th>Status Count </th> 
                                            <th> Gallery</th>
                                            <th> Children</th>
                                            @if($user->user_type === 'Admin')   <th>Actions</th>@endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($class as $c)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <!--<td>{{ $c->center->center_name ?? 'N/A' }}</td>-->
                                                <td>{{ $c->class_name }}</td>
                                                <td>{{ $c->amount_of_children }}</td>
                                                <td><a href="{{ asset($c->classroom_schedules) }}" target="_blank" class="btn btn-sm btn-primary">
View</td>
                                                @php
    // Extract numbers from total_currently_enrolled string
    preg_match('/Active: (\d+)/', $c->total_currently_enrolled, $active);
    preg_match('/Withdrawn: (\d+)/', $c->total_currently_enrolled, $withdrawn);
@endphp
<td>
    <span class="badge bg-success">Active: {{ $active[1] ?? 0 }}</span>
    <span class="badge bg-info ms-2">Withdrawn: {{ $withdrawn[1] ?? 0 }}</span>
</td>

                                                 <td> <a href="{{ route('class_masters.gallery', $c->class_id) }}" class="btn btn-sm btn-primary">  Gallery</a></td>
                                                <!--<td><a href="{{ route('class_masters.children', $c->class_id) }}" class="btn btn-secondary btn-sm">View</a></td> -->
   <td><a href="{{ route('class_masters.children', $c->class_id) }}"  class="btn btn-sm btn-primary">
View</td>
                                                     

    @if($user->user_type == 'Admin')
                                                <td class="text-center">
                                                    <!-- Edit Icon -->
                                                    
                                                    <a href="{{ url('class-masters/' . $c->class_id. '/edit') }}" class="icon-btn edit-icon" title="Edit">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                
                                                    <!-- Delete Form with Icon -->
                                                    <form action="{{ url('class-masters/' . $c->class_id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="icon-btn delete-icon" title="Delete"
                                                            onclick="return confirm('Are you sure you want to delete this class?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
@endif

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
        <!-- CARD END -->

    </div>
      <script>
     document.getElementById('resetBtns').addEventListener('click', function () {
        document.getElementById('filterForm').reset();
       window.location.href = "{{ route('class-masters.index') }}";
    });
    </script>
@endsection