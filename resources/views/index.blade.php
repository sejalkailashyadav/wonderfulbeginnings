@extends('layouts.app')

@section('styles')
@endsection

@section('content')
<!-- PAGE-HEADER -->
<div class="page-header">
    <h1 class="page-title">Cocomelonlearning Dashboard</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);"></a></li>
        <li class="breadcrumb-item active" aria-current="page"> </li>
    </ol>
</div>
<!-- PAGE-HEADER END -->

<div class="row row-sm mt-lg-4">
    <div class="col-sm-12 col-lg-12 col-xl-12">
        <div class="card bg-primary custom-card card-box">
            <div class="card-body p-4">
                @php
                    $user = session('user');
                    $userModel = \App\Models\UserManagements::with('center')->find($user->user_id);
                @endphp

                @if ($userModel)
                    <h3 class="text-white">Welcome, {{ $userModel->user_name }}</h3>
                    <p class="text-white mb-0">Role: {{ $userModel->user_type }}</p>
                    <p class="text-white mb-0">Username: {{ $userModel->user_name }}</p>

                    @if($userModel->center)
                        <p class="text-white mb-0">Center: {{ $userModel->center->center_name }}</p>
                    @endif
                @else
                    <p class="text-white">User not found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@if($user->user_type === 'Admin')
<!-- SUMMARY CARDS -->
<div class="row row-sm-12">
    <div class="col-sm-2 col-lg-3">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h5>Total Centers</h5>
                <h2>{{ \App\Models\CenterManagements::count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-2 col-lg-2">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h5>Total Classes</h5>
                <h2>{{ \App\Models\ClassMaster::count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-2 col-lg-2">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h5>Total Fees</h5>
                <h2>{{ \App\Models\CurrentFeesMaster::count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-2 col-lg-2">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h5>Total Children</h5>
                <h2>{{ \App\Models\CurrentChildMaster::count() }}</h2>
            </div>
        </div>
    </div>
    <div class="col-sm-2 col-lg-2">
        <div class="card custom-card">
            <div class="card-body text-center">
                <h5>Total Employee </h5>
                <h2>{{ \App\Models\EmployeeMaster::count() }}</h2>
            </div>
        </div>
    </div>
   
</div>
 

        <!-- QUICK ACTIONS CARD -->
            <div class="row row-sm mt-4">
                <div class="col-lg-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h3 class="card-title">Quick Actions</h3>
                        </div>
                        <div class="card-body d-flex flex-wrap justify-content-start gap-3">
                            <a href="{{ route('center-managements.index') }}" class="btn btn-primary">
                                <i class="fe fe-home me-1"></i> Manage Centers
                            </a>
                            <a href="{{ route('class-masters.index') }}" class="btn btn-info">
                                <i class="fe fe-layers me-1"></i> Manage Classes
                            </a>
                            <a href="{{ route('current-fees-master.index') }}" class="btn btn-success">
                                <i class="fe fe-dollar-sign me-1"></i> Manage Fees
                            </a>
                            <a href="{{ route('current-child-masters.index') }}" class="btn btn-warning">
                                <i class="fe fe-users me-1"></i> Manage Children
                            </a>
                            
                            <a href="{{ route('employee_masters.index') }}" class="btn btn-secondary">
                                <i class="fe fe-user-plus me-1"></i> Manage Employees
                            </a>
                            <a href="{{ route('waiting-lists.index') }}" class="btn btn-teal">
                                <i class="fe fe-clock me-1"></i> Waiting List
                            </a>
                            <a href="{{ route('employee_waitlist.index') }}" class="btn btn-danger">
                                <i class="fe fe-log-out me-1"></i> Withdrawals
                            </a>
                             <a href="{{ route('notifications.index') }}" class="btn btn-cyan">
                                <i class="fe fe-bell me-1"></i> Notifications
                            </a>
                        </div>

                    </div>
                </div>
            </div>
 @endif
 @if($user->user_type === 'Manager')
                   <div class="row row-sm mt-4">
                                <div class="col-lg-12">
                                    <div class="card custom-card">
                                        <div class="card-header">
                                            <h3 class="card-title">Quick Actions</h3>
                                        </div>
                                        <div class="card-body d-flex flex-wrap justify-content-start gap-3">
                                            <a href="{{ route('center-managements.index') }}" class="btn btn-primary">
                                                <i class="fe fe-home me-1"></i> Centers
                                            </a>
                                            <a href="{{ route('class-masters.index') }}" class="btn btn-info">
                                                <i class="fe fe-layers me-1"></i> Classes
                                            </a>
                                            <a href="{{ route('current-child-masters.index') }}" class="btn btn-warning">
                                                <i class="fe fe-users me-1"></i> Children
                                            </a>
                                             <a href="https://erp.cocomelonlearning.com/center-month-filter" class="btn btn-secondary">
                                                <i class="fe fe-user-plus me-1"></i> Reports
                                            </a>
                                            </div>
                                            </div>
                
                                    </div>
                                </div>
                            </div>
                            
 @endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
