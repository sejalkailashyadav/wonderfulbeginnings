@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Create Program</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Program</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <!-- FORM CARD -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">Program Information</h3>
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

                        <form action="{{ url('program-create') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Program Name <span class="text-danger">*</span></label>
                                    <input type="text" name="program_name" class="form-control"
                                        placeholder="Enter program name" required>
                                </div>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Create Program</button>
                                <a href="{{ url('program-masters') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>


                        <!-- Display all programs -->
                        <div class="mt-5">
                            <h4>All Programs</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Program Name</th>
                                        <th>delete </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programs as $program)
                                        <tr>
                                            <td>{{ $program->prog_master_id }}</td>
                                            <td>{{ $program->program_name }}</td>
                                            <!-- <td>
                                                                <form action="{{ route('program.destroy', $program->prog_master_id) }}"
                                                                    method="POST"
                                                                    onsubmit="return confirm('Are you sure you want to delete this program?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                                </form>

                                                            </td> -->

                                            <td>
                                                <!-- Edit Button -->
                                                <a href="{{ route('program-create.edit', $program->prog_master_id) }}"
                                                    class="btn btn-sm btn-info">Edit</a>

                                                <!-- Delete Form -->
                                                <form action="{{ route('program.destroy', $program->prog_master_id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this program?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FORM CARD END -->

    </div>
@endsection