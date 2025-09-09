@extends('layouts.app')

@section('content')
<h4>Edit Monthly Report for {{ $report->child->child_first_name }} {{ $report->child->child_last_name }}</h4>

<form action="{{ route('monthly-report.update', $report->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="monthly_fee">Monthly Fee</label>
        <input type="number" name="monthly_fee" class="form-control" value="{{ $report->monthly_fee }}" step="0.01" required>
    </div>

    <div class="mb-3">
        <label for="ccfri">CCFRI</label>
        <input type="number" name="ccfri" class="form-control" value="{{ $report->ccfri }}" step="0.01" required>
    </div>
<div class="form-group">
    <label>ACCB</label>
    <input type="number" step="0.01" name="accb" value="{{ $report->accb }}" class="form-control">
</div>
    <div class="mb-3">
        <label for="total">Total</label>
        <input type="number" name="total" class="form-control" value="{{ $report->total }}" step="0.01" required>
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
