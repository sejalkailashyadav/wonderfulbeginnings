
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="margin-top: 180px; position: relative; z-index: 5;">
        <h1 class="h4 text-black fw-bold mb-0">Add New Employee (Waitlist)</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee (Waitlist)</li>
        </ol>
    </div>

    <!-- FORM CARD -->
    <div class="card shadow-sm border-0">
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
    <form action="{{ route('employee_waitlist.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('employee_waitlist.form')

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
