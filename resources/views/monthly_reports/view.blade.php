@extends('layouts.app') <!-- or whatever layout you use -->

@section('content')
<div class="container">
    <h2>Monthly Report for {{ $report->child->name ?? 'N/A' }}</h2>

    <p><strong>Month:</strong> {{ $report->month }}</p>
    <p><strong>Class:</strong> {{ $report->class->name ?? 'N/A' }}</p>
    <p><strong>Monthly Fee:</strong> ${{ number_format($report->monthly_fee, 2) }}</p>
    <p><strong>CCFRI:</strong> ${{ number_format($report->ccfri, 2) }}</p>
    <p><strong>Total:</strong> ${{ number_format($report->total, 2) }}</p>

    <a href="{{ route('monthly-report.edit', $report->id) }}" class="btn btn-warning">Edit Report</a>
    <a href="{{ route('center.month.filter') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
