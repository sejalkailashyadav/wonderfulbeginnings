@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Monthly Report for {{ $report->child->child_name ?? 'N/A' }}</h2>

    <p><strong>Month:</strong> {{ $report->month }}</p>
    <p><strong>Center:</strong> {{ $report->child->center->center_name ?? 'N/A' }}</p>
    <p><strong>Class:</strong> {{ $report->child->class->class_name ?? 'N/A' }}</p>
    <p><strong>Monthly Fee:</strong> ${{ number_format($report->monthly_fee, 2) }}</p>
    <p><strong>CCFRI:</strong> ${{ number_format($report->ccfri, 2) }}</p>
     <p><strong>Institution Number:</strong> {{ $report->institution_number }}</p>
      <p><strong>Transit Number:</strong> {{ $report->transit_number }}</p>
       <p><strong>Account Number:</strong> {{ $report->account_number }}</p>
    <p><strong>Total:</strong> ${{ number_format($report->total, 2) }}</p>

    <a href="{{ route('monthly-report.edit', $report->id) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('center.month.filter') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
