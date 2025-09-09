@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Create Class Managment</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Center</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- FORM CARD -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">Class Information</h3>
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

                     <form action="{{ route('class-masters.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Class Name</label>
        <input type="text" name="class_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Amount of Children</label>
        <input type="number" name="amount_of_children" class="form-control">
    </div>

    <div class="form-group">
        <label>Currently Enrolled</label>
        <input type="number" name="total_currently_enrolled" class="form-control">
    </div>

    <div class="form-group">
        <label>Upload Schedule (PDF)</label>
        <input type="file" name="classroom_schedules" class="form-control">
    </div>

    <input type="hidden" name="center_id" value="{{ $center_id }}">

    <button type="submit" class="btn btn-primary">Save</button>
</form>
                    </div>
                </div>
            </div>
        </div>
        <!-- FORM CARD END -->

    </div>
@endsection