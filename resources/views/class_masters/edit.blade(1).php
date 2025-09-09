@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Edit Class Managment</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Center</li>
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
  
                     <form action="{{ url('class-masters/' . $class->class_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
   @method('PUT')
    <div class="form-group">
        <label>Class Name</label>
        <input type="text" name="class_name" class="form-control" value="{{ $class->class_name }}" >
    </div>

    <div class="form-group">
        <label>Amount of Children</label>
        <input type="number" name="amount_of_children" value="{{ $class->amount_of_children }}" class="form-control">
    </div>
    @if($class->classroom_schedules)
        <p>Current Schedule: <a href="{{ asset($class->classroom_schedules) }}" target="_blank">View</a></p>
    @endif
    

    <div class="form-group">
        <label>Upload Classroom Schedules Doc (PDF)</label>
        <input type="file" name="classroom_schedules" class="form-control">
    </div>

 

      <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Center</button>
                            <a href="{{ url('class-masters') }}" class="btn btn-secondary">Cancel</a>
                        </div>
</form>
                    </div>
                </div>
            </div>
        </div>
        <!-- FORM CARD END -->

    </div>
@endsection