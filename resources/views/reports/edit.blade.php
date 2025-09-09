@extends('layouts.app')

@section('content')
<div class="container">
<a href="{{ url('/monthly-reports') }}" style ="margin-left: 815px; margin-top: 8px;"
class="btn btn-secondary mb-3">Back to Monthly Reports</a>
    <h2>Edit Report Log</h2>
    <form method="POST" action="{{ url('/report-logs/'.$log->report_log_id) }}">
        @csrf
        @method('PUT')

        
        <div class="mb-3">
            <label>Child Name</label>
            <input type="text" name="child_name" class="form-control" value="{{ $log->child_name }}">
        </div>
        <div class="mb-3">
            <label>Parent Name</label>
            <input type="text" name="parent_name" class="form-control" value="{{ $log->parent_name }}">
        </div>
        <div class="mb-3">
            <label>Number of Days</label>
            <input type="number" name="number_of_days" class="form-control" value="{{ $log->number_of_days }}">
        </div>
        <div class="mb-3">
            <label>Total Fees</label>
            <input type="text" name="total_fees" class="form-control" value="{{ $log->total_fees }}">
        </div>
        <div class="mb-3">
            <label>CCFRI</label>
            <input type="text" name="ccfri" class="form-control" value="{{ $log->ccfri }}">
        </div>
        <div class="mb-3">
            <label>ACCB</label>
            <input type="text" name="accb" class="form-control" value="{{ $log->accb }}">
        </div>
        <div class="mb-3">
            <label>Received Parent Fees</label>
            <input type="text" name="received_parent_fees" class="form-control" value="{{ $log->received_parent_fees }}">
        </div>
        <div class="mb-3">
            <label>Date of Birth</label>
            <input type="date" name="date_of_birth" class="form-control" value="{{ $log->date_of_birth }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
