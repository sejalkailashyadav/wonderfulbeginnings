@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="page-header">
        <h1 class="page-title">Edit Manager</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Manager</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Manager Information</h3>
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

                    <form action="{{ url('manager-masters/' . $manager->manager_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="manager_name" class="form-label">Manager Name <span class="text-danger">*</span></label>
                            <input type="text" name="manager_name" class="form-control" value="{{ $manager->manager_name }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="manager_email" class="form-label">Manager Email <span class="text-danger">*</span></label>
                            <input type="email" name="manager_email" class="form-control" value="{{ $manager->manager_email }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="manager_num" class="form-label">Manager Number <span class="text-danger">*</span></label>
                            <input type="text" name="manager_num" class="form-control" value="{{ $manager->manager_num }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Select Center <span class="text-danger">*</span></label>
                            <select name="center_id" class="form-control" required>
                                <option value="">Select Center</option>
                                @foreach($centers as $center)
                                    <option value="{{ $center->center_id }}" {{ $center->center_id == $manager->center_id ? 'selected' : '' }}>
                                        {{ $center->center_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Manager</button>
                            <a href="{{ url('manager-masters') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
