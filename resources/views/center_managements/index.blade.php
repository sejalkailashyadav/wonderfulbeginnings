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
    </style>
</head>
@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Center Management</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Center List</li>
            </ol>
        </div>
          @php $user = session('user'); @endphp
          
        <!-- PAGE HEADER END -->
 <!--@if (session('success'))-->
 <!--           <div class="alert alert-success">{{ session('success') }}</div>-->
 <!--       @endif-->

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- CENTER LIST CARD -->
        <div class="row">
            <div class="col-md-12">
                <div class="card custom-card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      
                       

    @if($user->user_type === 'Admin')  <a href="{{ url('center-managements/create') }}" class="btn btn-primary btn-sm">+ Create New
                            Center</a>@endif
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

    <!--                    @if ($centers->isEmpty())-->
    <!--                        <div class="alert alert-info">No centers found. <a-->
    <!--                                href="{{ url('center-managements/create') }}">Create one</a>.</div>-->
    <!--                    @else-->
                          
    <!--                        <div class="table-responsive">-->
    <!--                            <table class="table table-bordered table-hover text-nowrap">-->
    <!--                                <thead class="table-light">-->
    <!--                                    <tr>-->
    <!--                                        <th>ID</th>-->
    <!--                                        <th>Center Name</th>-->
    <!--                                        <th>Center Address</th>-->
    <!--                                        <th>Center Email</th>-->
    <!--                                        <th>Phone number</th>-->
    <!--                                        <th>Licance no</th>-->
    <!--                                        <th>G number</th>-->
    <!--                                        <th>Facility number</th>-->
    <!--                                        <th>Licencing Officer name</th>-->
    <!--                                        <th>Licencing Officer email</th>-->
    <!--                                        <th>Licencing Officer Mo. No</th>-->
    <!--                                        <th>Number of Classrooms</th>-->
    <!--                                         <th>Business License Doc</th>-->
    <!--                                         <th>Facility License Doc</th>-->
    <!--                                         <th>Incorporation upload Doc</th>-->
    <!--                                        <th>View Gallery</th> -->
    <!--                                     @if($user->user_type === 'Admin')     <th>Actions</th>@endif-->
    <!--                                    </tr>-->
    <!--                                </thead>-->
    <!--                                <tbody>-->
    <!--                                    @foreach ($centers as $center)-->
    <!--                                        <tr>-->
    <!--                                            <td>{{ $loop->iteration }}</td>-->
    <!--                                            <td>{{ $center->center_name }}</td>-->
    <!--                                            <td>{{ $center->center_address }}</td>-->
    <!--                                            <td>{{ $center->center_email }}</td>-->
    <!--                                            <td>{{ $center->phone_number }}</td>-->
    <!--                                            <td>{{ $center->license_number }}</td>-->
    <!--                                            <td>{{ $center->g_number }}</td>-->
    <!--                                            <td>{{ $center->facility_number }}</td>-->
    <!--                                            <td>{{ $center->licensing_officer_name }}</td>-->
    <!--                                            <td>{{ $center->licensing_officer_email }}</td>-->
    <!--                                            <td>{{ $center->licensing_officer_mobile }}</td>-->
                                                <!--<td>{{ $center->number_of_classrooms }}</td>-->
    <!--                                              <td>{{ $center->classes_count }}</td>-->
    <!--                                              <td> <a href="{{ ($center->business_license_doc) }}" target="_blank">View</a></td>-->
    <!--                                            <td> <a href="{{ ($center->facility_license_doc) }}" target="_blank">View</a></td>-->
    <!--                                              <td> <a href="{{ ($center->incorporation_doc) }}" target="_blank">View</a></td>-->
                                                 
    <!--<td> <a href="{{ route('center_managements.gallery', $center->center_id) }}" class="btn btn-sm btn-primary"> View Gallery</a></td>-->
    <!--                                             @if($user->user_type === 'Admin') -->
    <!--                                            <td class="text-center">-->
                                                    <!-- Edit Icon -->
    <!--                                                <a href="{{ url('center-managements/' . $center->center_id . '/edit') }}"-->
    <!--                                                    class="icon-btn edit-icon" title="Edit">-->
    <!--                                                    <i class="fa-solid fa-pen"></i>-->
    <!--                                                </a>-->


                                                    <!-- Delete Form with Icon -->
    <!--                                                <form action="{{ url('center-managements/' . $center->center_id) }}"-->
    <!--                                                    method="POST" style="display:inline-block;">-->
    <!--                                                    @csrf-->
    <!--                                                    @method('DELETE')-->
    <!--                                                    <button type="submit" class="icon-btn delete-icon" title="Delete"-->
    <!--                                                        onclick="return confirm('Are you sure?')">-->
    <!--                                                        <i class="fa-solid fa-trash"></i>-->
    <!--                                                    </button>-->
    <!--                                                </form>-->

    <!--                                            </td>-->
    <!--                                        @endif-->

    <!--                                        </tr>-->
    <!--                                    @endforeach-->
    <!--                                </tbody>-->
    <!--                            </table>-->
    <!--                        </div>-->
    <!--                    @endif-->


@if ($centers->isEmpty())
    <div class="alert alert-info">No centers found. <a href="{{ url('center-managements/create') }}">Create one</a>.</div>
@else
@if($user->user_type === 'Admin')
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Center Name</th>
                    <th>Center Address</th>
                    <th>Center Email</th>
                    <th>Phone number</th>
                    <th>Licance no</th>
                    <th>G number</th>
                    <th>Facility number</th>
                    <th>Licencing Officer name</th>
                    <th>Licencing Officer email</th>
                    <th>Licencing Officer Mo. No</th>
                    <th>Number of Classrooms</th>
                    <th>Business License Doc</th>
                    <th>Facility License Doc</th>
                    <th>Incorporation upload Doc</th>
                    <th>CCFO Doc</th>
                    <th>Inspection Reports </th>
                    <th> Gallery</th> 
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($centers as $center)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $center->center_name }}</td>
                        <td>{{ $center->center_address }}</td>
                        <td>{{ $center->center_email }}</td>
                        <td>{{ $center->phone_number }}</td>
                        <td>{{ $center->license_number }}</td>
                        <td>{{ $center->g_number }}</td>
                        <td>{{ $center->facility_number }}</td>
                        <td>{{ $center->licensing_officer_name }}</td>
                        <td>{{ $center->licensing_officer_email }}</td>
                        <td>{{ $center->licensing_officer_mobile }}</td>
                        <td>{{ $center->classes_count }}</td>
                        <td><a href="{{ $center->business_license_doc }}" target="_blank"  class="btn btn-sm btn-primary">
View</td>
                        <td><a href="{{ $center->facility_license_doc }}" target="_blank" class="btn btn-sm btn-primary">
View</td>
                        <td><a href="{{ $center->incorporation_doc }}" target="_blank" class="btn btn-sm btn-primary">
View</td>
                        <td><a href="{{ $center->ccof }}" target="_blank" class="btn btn-sm btn-primary">
                        View</td>
                         <td><a href="{{ $center->inspection_reports }}" target="_blank" class="btn btn-sm btn-primary">
                        View</td>
                        

                        <td><a href="{{ route('center_managements.gallery', $center->center_id) }}" class="btn btn-sm btn-primary"> Gallery</a></td>
                        <td class="text-center">
                            <a href="{{ url('center-managements/' . $center->center_id . '/edit') }}" class="icon-btn edit-icon" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ url('center-managements/' . $center->center_id) }}" method="POST" style="display:inline-block;">
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

    @else
        <!--@foreach ($centers as $center)-->
        <!--    <div class="card mb-4">-->
        <!--        <div class="card-header">-->
        <!--            <h5 class="mb-0">{{ $center->center_name }}</h5>-->
        <!--        </div>-->
        <!--        <div class="card-body">-->
        <!--            <p><strong>Address:</strong> {{ $center->center_address }}</p>-->
        <!--            <p><strong>Email:</strong> {{ $center->center_email }}</p>-->
        <!--            <p><strong>Phone:</strong> {{ $center->phone_number }}</p>-->
        <!--            <p><strong>License No:</strong> {{ $center->license_number }}</p>-->
        <!--            <p><strong>G Number:</strong> {{ $center->g_number }}</p>-->
        <!--            <p><strong>Facility No:</strong> {{ $center->facility_number }}</p>-->
        <!--            <p><strong>Licensing Officer:</strong> {{ $center->licensing_officer_name }}</p>-->
        <!--            <p><strong>Officer Email:</strong> {{ $center->licensing_officer_email }}</p>-->
        <!--            <p><strong>Officer Mobile:</strong> {{ $center->licensing_officer_mobile }}</p>-->
        <!--            <p><strong>Number of Classrooms:</strong> {{ $center->classes_count }}</p>-->
        <!--            <p><strong>Business License:</strong> <a href="{{ $center->business_license_doc }}" target="_blank">View</a></p>-->
        <!--            <p><strong>Facility License:</strong> <a href="{{ $center->facility_license_doc }}" target="_blank">View</a></p>-->
        <!--            <p><strong>Incorporation Doc:</strong> <a href="{{ $center->incorporation_doc }}" target="_blank">View</a></p>-->
        <!--            <p><a href="{{ route('center_managements.gallery', $center->center_id) }}" class="btn btn-sm btn-primary">View Gallery</a></p>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--@endforeach-->
           @foreach ($centers as $center)
    <div class="card shadow-sm rounded mb-4 border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $center->center_name }}</h5>
            <a href="{{ route('center_managements.gallery', $center->center_id) }}" class="btn btn-light btn-sm">📷 Gallery</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>📍 Address:</strong> {{ $center->center_address }}</p>
                    <p><strong>📧 Email:</strong> <a href="mailto:{{ $center->center_email }}">{{ $center->center_email }}</a></p>
                    <p><strong>📞 Phone:</strong> {{ $center->phone_number }}</p>
                    <p><strong>🔒 License No:</strong> {{ $center->license_number }}</p>
                    <a href="{{ asset($center->inspection_reports) }}" target="_blank" class="btn btn-link p-0">View Document</a>
                    
                    <!--<p><strong>🏷️ G Number:</strong> {{ $center->g_number }}</p>-->
                    <!--<p><strong>🏢 Facility No:</strong> {{ $center->facility_number }}</p>-->
                </div>
                <div class="col-md-6">
                    <p><strong>👮 Licensing Officer:</strong> {{ $center->licensing_officer_name }}</p>
                    <p><strong>📩 Officer Email:</strong> <a href="mailto:{{ $center->licensing_officer_email }}">{{ $center->licensing_officer_email }}</a></p>
                    <p><strong>📱 Officer Mobile:</strong> {{ $center->licensing_officer_mobile }}</p>
                    <p><strong>🏫 Classrooms:</strong> <span class="badge bg-info text-dark">{{ $center->classes_count }}</span></p>
                    <p><strong>📄 Business License:</strong> 
                        <a href="{{ $center->business_license_doc }}" target="_blank">View</a>
                    </p>
                    <p><strong>🏬 Facility License:</strong> 
                        <a href="{{ $center->facility_license_doc }}" target="_blank">View</a>
                    </p>
                    
                    
                    
                    
                    <!--<p><strong>🗃️ Incorporation Doc:</strong> -->
                    <!--    <a href="{{ $center->incorporation_doc }}" target="_blank">View</a>-->
                    <!--</p>-->
                </div>
            </div>
        </div>
    </div>
@endforeach
    @endif
@endif

                    </div>
                </div>
            </div>
        </div>
        <!-- CARD END -->

    </div>
@endsection