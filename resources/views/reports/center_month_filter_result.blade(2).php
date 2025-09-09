@extends('layouts.app')

@section('content')
<style>
    .hidden-field {
        display: none;
    }
</style>

<div class="container-fluid mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
        <h3 class="fw-bold mb-2">Children List</h3>
        <div class="text-muted small">
            <strong>Center Name:</strong> {{ $children[0]->child->center->center_name ?? 'N/A' }} |
            <strong>Month:</strong> {{ $report_month }}
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($children->isEmpty())
        <div class="alert alert-warning">No children found for the selected center and month.</div>
    @else

        <form action="{{ route('monthly-report.bulk-update') }}" method="POST">
            @csrf

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>Child ID</th>
                            <th>Child Name</th>
                            <th>Parent Name</th>
                            <th>Class</th>
                            <th>Fee Plan</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($children as $index => $report)
                            @php
                                $selectedPlanId = $report->child->fees_id;
                                $plansForCenterAndClass = $feePlans
                                    ->where('center_id', $report->center_id)
                                    ->where('class_id', $report->class_id);
                                $selectedPlan = $plansForCenterAndClass->firstWhere('id', $selectedPlanId);
                                $otherPlans = $plansForCenterAndClass->filter(fn($plan) => $plan->id !== $selectedPlanId);
                            @endphp

                            <input type="hidden" name="reports[{{ $index }}][id]" value="{{ $report->id }}">

                            <tr>
                                <td class="text-center">{{ $report->child->child_id }}</td>
                                <td>{{ $report->child->child_first_name }} {{ $report->child->child_last_name }}</td>
                                <td>{{ $report->child->parent_first_name }} {{ $report->child->parent_last_name }}</td>
                                <td class="text-center">{{ $report->child->class->class_name ?? 'N/A' }}</td>

                                <!-- Fee Plan Dropdown -->
                                <td>
                                    <select name="reports[{{ $index }}][fee_plan_id]" class="form-select fee-plan-select" data-index="{{ $index }}" data-center="{{ $report->center_id }}" required>
                                        @if($selectedPlan)
                                            <option value="{{ $selectedPlan->id }}"
                                                data-monthly_fee="{{ $selectedPlan->monthly_fees }}"
                                                data-ccfri="{{ $selectedPlan->ccfri }}"
                                                data-accb="0"
                                                selected>
                                                {{ $selectedPlan->fees_name }}
                                            </option>
                                        @else
                                            <option value="" disabled selected>-- Select Plan --</option>
                                        @endif

                                        @foreach($otherPlans as $plan)
                                            <option value="{{ $plan->id }}"
                                                data-monthly_fee="{{ $plan->monthly_fees }}"
                                                data-ccfri="{{ $plan->ccfri }}"
                                                data-accb="0">
                                                {{ $plan->fees_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>

                                <!-- Notes -->
                                <td>
                                    <input type="text" name="reports[{{ $index }}][notes]" value="{{ $report->notes }}" class="form-control" placeholder="Enter notes (optional)" />
                                </td>

                                <!-- Hidden Fields -->
                                <td>
                                    <input class="hidden-field" type="number" step="0.01" name="reports[{{ $index }}][monthly_fee]" id="monthly_fee_{{ $index }}" value="{{ $report->monthly_fee }}">
                                    <input class="hidden-field" type="number" step="0.01" name="reports[{{ $index }}][ccfri]" id="ccfri_{{ $index }}" value="{{ $report->ccfri }}">
                                    <input class="hidden-field" type="number" step="0.01" name="reports[{{ $index }}][accb]" id="accb_{{ $index }}" value="{{ $report->accb }}">
                                    <input class="hidden-field" type="number" step="0.01" name="reports[{{ $index }}][total]" id="total_{{ $index }}" value="{{ $report->total }}" readonly>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-center mt-4">
                <button type="submit" class="btn btn-primary px-4">Create Report</button>
            </div>
        </form>

    @endif

    <!-- Go Back Button -->
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('center.month.filter') }}" class="btn btn-secondary">Go Back</a>
    </div>
</div>

<!-- Script to update hidden fields -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const selects = document.querySelectorAll('.fee-plan-select');

        selects.forEach(select => {
            select.addEventListener('change', function () {
                const index = this.getAttribute('data-index');
                const selected = this.options[this.selectedIndex];

                const monthlyFee = parseFloat(selected.getAttribute('data-monthly_fee')) || 0;
                const ccfri = parseFloat(selected.getAttribute('data-ccfri')) || 0;
                const accb = 0; 

                const total = monthlyFee - ccfri - accb;

                document.getElementById(`monthly_fee_${index}`).value = monthlyFee.toFixed(2);
                document.getElementById(`ccfri_${index}`).value = ccfri.toFixed(2);
                document.getElementById(`accb_${index}`).value = accb.toFixed(2);
                document.getElementById(`total_${index}`).value = total.toFixed(2);
            });
        });
    });
</script>
@endsection
