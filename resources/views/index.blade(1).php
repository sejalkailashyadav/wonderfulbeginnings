
@extends('layouts.app')

@section('styles')
@endsection

@section('content')
	<!-- PAGE-HEADER -->
	<div class="page-header">
		<h1 class="page-title">Dashboard</h1>
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

    // Fetch full user model from DB with center relation
    $userModel = \App\Models\UserManagements::with('center')->find($user->user_id);
@endphp

@if ($userModel)
    <h3 class="text-white">Welcome, {{ $userModel->user_name }}</h3>
    <p class="text-white mb-0">Role: {{ $userModel->user_type }}</p>
    <!--<p class="text-white mb-0">Email: {{ $userModel->email ?? 'N/A' }}</p>-->
    <p class="text-white mb-0">Username: {{ $userModel->user_name }}</p>
    
    @if($userModel->center)
        <p class="text-white mb-0">Center: {{ $userModel->center->center_name }}</p>
    @else
        <p class="text-white mb-0"></p>
    @endif
@else
    <p class="text-white">User not found.</p>
@endif

				</div>
			</div>
		</div>
	</div>
@endsection

@section('scripts')
@endsection
