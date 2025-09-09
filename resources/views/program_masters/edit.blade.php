@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1 class="page-title">Edit Program</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('program-masters') }}">Programs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Program</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Update Program Information</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ url('program-masters/' . $program->program_id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- <div class="form-group mb-3">
                            <label>Select Center <span class="text-danger">*</span></label>
                            <select name="center_id" class="form-control" required>
                                <option value="">Select Center</option>
                                @foreach($centers as $center)
                                    <option value="{{ $center->center_id }}" {{ $center->center_name ? 'selected' : '' }}>
                                        {{ $center->center_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div> -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="center_id">Center</label>
                                <select name="center_id" class="form-control" required>
                                    <option value="">Select Center</option>
                                    @foreach ($centers as $center)
                                        <option value="{{ $center->center_id }}" {{ $program->center_id == $center->center_id ? 'selected' : '' }}>
                                            {{ $center->center_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

    <div class="form-group">
        <label for="prog_master_id">Program Name</label>
        <select name="prog_master_id" class="form-control" >
            @foreach ($pros as $p)
                <option value="{{ $p->prog_master_id }}" {{ $program->prog_master_id == $p->prog_master_id ? 'selected' : '' }}>
                    {{ $p->program_name }}
                </option>
            @endforeach
        </select>
    </div>
                            <div class="form-group mb-3">
                                <label for="number_of_days" class="form-label">Number of Days <span class="text-danger">*</span></label>
                                <select name="number_of_days" class="form-control" required>
                                    <option value="">Select days</option>
                                    <option value="1" {{ $program->number_of_days == '1' ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $program->number_of_days == '2' ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $program->number_of_days == '3' ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $program->number_of_days == '4' ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $program->number_of_days == '5' ? 'selected' : '' }}>5</option>
                                    <option value="6" {{ $program->number_of_days == '6' ? 'selected' : '' }}>6</option>
                                    <option value="7" {{ $program->number_of_days == '7' ? 'selected' : '' }}>7</option>
                                </select>
                            </div>

                        <div class="form-group mb-3">
                            <label>Program Fees</label>
                            <input type="number" step="0.01" name="program_fees" class="form-control" value="{{ $program->program_fees }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>CCFRI</label>
                            <input type="number" step="0.01" name="ccfri" class="form-control" value="{{ $program->ccfri }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <!-- <label>ACCB</label> -->
                            <input type="number" step="0.01" name="accb" class="form-control" value="{{ $program->accb }}" hidden>
                        </div>

                        <div class="form-group mb-3">
                            <!-- <label>Parent Fees</label> -->
                            <input type="number" step="0.01" name="parent_fees" class="form-control" value="{{ $program->parent_fees }}"  hidden>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Update Program</button>
                            <a href="{{ url('program-masters') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
