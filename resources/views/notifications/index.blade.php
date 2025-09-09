
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
        .card-header {
    font-size: 1.25rem;
    font-weight: 600;
}
.card-body p {
    margin-bottom: 0.5rem;
}
.badge {
    font-size: 0.95rem;
    padding: 0.4em 0.6em;
}
.hidden sm:flex-1 sm:flex sm:items-center sm:justify-between
{
    display: none;
}
    </style>
</head>
@extends('layouts.app')

@section('content')
 <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Notifications</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Notifications</li>
            </ol>
        </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($notifications->count())
       <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="table-light">
                <tr>
                   
                    <th>Child</th>
                    <th>Action</th>
                    <th>Center</th>
                    <th>Child name</th>
                    <th>Child Details</th>
                </tr>
            </thead>
            <tbody>
                @foreach($notifications as $n)
                    @php
                        $data = $n->data;
                        //for center name 
                         $center = \App\Models\CenterManagements::find($data['center_id']);
                    @endphp
                    <tr>
                        
                        <td>{{ $data['child_name'] ?? 'N/A' }}</td>
                     <!--<td> <span class="badge bg-success">{{ ucfirst($data['action']=="approved" ? "Child Approved" : 'Child Withdrawn' ?? '-') }}</span></td>-->
                     
                  <td><span style="display:inline-block;padding:2px 8px;border-radius:12px;
    background:
        {{ $data['action'] == 'approved' ? '#22c55e' : 
           ($data['action'] == 'withdrawn' ? '#ef4444' : 
           ($data['action'] == 'created' ? '#8b5cf6' : '#3b82f6')) }}; 
    color:#fff;font-size:12px;">
    {{ ucfirst($data['action'] == 'approved' ? 'approved' : 
           ($data['action'] == 'withdrawn' ? 'withdrawn' : 
           ($data['action'] == 'created' ? 'created' : 'created'))) }}
</span></td>   


                        <td>{{ $center->center_name ?? 'N/A' }}</td>
                         <td>{{ $data['child_name'] ?? '-' }}</td>
                        <td><a href="{{ $data['detailUrl'] ?? '-' }}" class="btn btn-sm btn-primary">
View</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  
     
    @else
        <div class="alert alert-info">No notifications found.</div>
    @endif
</div>
@endsection

