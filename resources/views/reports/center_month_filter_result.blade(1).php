@extends('layouts.app')

@section('content')
<style>
    
    .hidden-field {
        display: none;
    }


</style>
<br>
<div>
<h4>
  <h3><b> Children List</b></h3>  
     Center Name - {{ $children[0]->child->center->center_name
 ?? 'N/A' }} |
    Month: {{ $report_month }}
</h4>
  
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif



@if($children->isEmpty())
    <p>No children found for the selected center and month.</p>
@else
   <table class="table table-bordered mt-10">
    <tbody>
       <form action="{{ route('monthly-report.bulk-update') }}" method="POST">
    @csrf

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Child ID</th>
                <th>Child Name</th>
                <th>Parent Name</th>
                <th>Class</th>
                <th>Fee Plan</th>
                <th>Notes</th>
                <!--<th>Monthly Fees</th>-->
                <!--<th>CCFRI</th>-->
                <!--<th>ACCB</th>-->
                <!--<th>Total</th>-->
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
                    <td>{{ $report->child->child_id }}</td>
                    <td>{{ $report->child->child_first_name }} {{ $report->child->child_last_name }}</td>
                    <td>{{ $report->child->parent_first_name }} {{ $report->child->parent_last_name }}</td>
                    <td>{{ $report->child->class->class_name ?? 'N/A' }}</td>
                      
                    
                    <!--<td>{{ $report->child->fee->fees_name ?? 'N/A' }}</td>-->
                    <!--<td>-->
                    <!--    <select name="reports[{{ $index }}][fee_plan_id]" class="form-control fee-plan-select" data-index="{{ $index }}" data-center="{{ $report->center_id }}" required>-->
                    <!--        <option value="">-- Select Plan --</option>-->
                    <!--        @foreach($feePlans->where('center_id', $report->center_id) as $plan)-->
                    <!--            <option value="{{ $plan->id }}"-->
                    <!--                data-monthly_fee="{{ $plan->monthly_fees }}"-->
                    <!--                data-ccfri="{{ $plan->ccfri }}"-->
                    <!--                data-accb="0"-->
                    <!--                @if($report->child->fee_id == $plan->id) selected @endif>-->
                    <!--                {{ $plan->fees_name }}-->
                    <!--            </option>-->
                    <!--        @endforeach-->
                    <!--    </select>-->
                    
                    
                    
<!--                    <td>-->
<!--    <select name="reports[{{ $index }}][fee_plan_id]" class="form-control fee-plan-select" data-index="{{ $index }}" data-center="{{ $report->center_id }}" required>-->
<!--        @php-->
<!--            $selectedPlanId = $report->child->fees_id;-->
<!--            $plansForCenter = $feePlans->where('center_id', $report->center_id);-->
<!--            $selectedPlan = $plansForCenter->firstWhere('id', $selectedPlanId);-->
<!--            $otherPlans = $plansForCenter->filter(fn($plan) => $plan->id !== $selectedPlanId);-->
<!--        @endphp-->

<!--        @if($selectedPlan)-->
<!--            <option value="{{ $selectedPlan->id }}"-->
<!--                data-monthly_fee="{{ $selectedPlan->monthly_fees }}"-->
<!--                data-ccfri="{{ $selectedPlan->ccfri }}"-->
<!--                data-accb="0"-->
<!--                selected>-->
<!--                {{ $selectedPlan->fees_name }}-->
<!--            </option>-->
<!--        @else-->
<!--            <option value="" disabled selected>-- Select Plan --</option>-->
<!--        @endif-->

<!--        @foreach($otherPlans as $plan)-->
<!--            <option value="{{ $plan->id }}"-->
<!--                data-monthly_fee="{{ $plan->monthly_fees }}"-->
<!--                data-ccfri="{{ $plan->ccfri }}"-->
<!--                data-accb="0">-->
<!--                {{ $plan->fees_name }}-->
<!--            </option>-->
<!--        @endforeach-->
<!--    </select>-->
<!--</td>-->



<td>
    <select name="reports[{{ $index }}][fee_plan_id]" class="form-control fee-plan-select" data-index="{{ $index }}" data-center="{{ $report->center_id }}" required>
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

<td>
    <input type="text" name="reports[{{ $index }}][notes]" value="{{ $report->notes }}" class="form-control" />
</td>

                      <td>
                    
                    
                                    <input class="hidden-field" type="number" step="0.01" name="reports[{{ $index }}][monthly_fee]" class="form-control monthly-fee" id="monthly_fee_{{ $index }}" value="{{ $report->monthly_fee }}" >
                                </td>
                                <td>
                                    <input class="hidden-field"  type="number" step="0.01" name="reports[{{ $index }}][ccfri]" class="form-control ccfri" id="ccfri_{{ $index }}" value="{{ $report->ccfri }}" >
                                </td>
                                <td>
                                    <input class="hidden-field"  type="number" step="0.01" name="reports[{{ $index }}][accb]" class="form-control accb" id="accb_{{ $index }}" value="{{ $report->accb }}" >
                                </td>
                                <td>
                                    <input class="hidden-field" type="number" step="0.01" name="reports[{{ $index }}][total]" class="form-control total" id="total_{{ $index }}" value="{{ $report->total }}"  readonly>
                                </td>
                    <!--</td>-->
                    <!--                    <input type="hidden" name="reports[{{ $index }}][id]" value="{{ $report->id }}">-->

                    <!--<td>-->
                    <!--    <input type="number" step="0.01" name="reports[{{ $index }}][monthly_fee]" value="{{ $report->monthly_fee }}" class="form-control" required>-->
                    <!--</td>-->
                    <!--<td>-->
                    <!--    <input type="number" step="0.01" name="reports[{{ $index }}][ccfri]" value="{{ $report->ccfri }}" class="form-control" required>-->
                    <!--</td>-->
                    <!--<td>-->
                    <!--    <input type="number" step="0.01" name="reports[{{ $index }}][accb]" value="{{ $report->accb }}" class="form-control" required>-->
                    <!--</td>-->
                    <!--<td>-->
                    <!--    <input type="number" step="0.01" name="reports[{{ $index }}][total]" value="{{ $report->total }}" class="form-control" required>-->
                    <!--</td>-->
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary"  style="margin-left: 45%;">Create Report</button>
</form>

    </tbody>
</table>
@endif
<br>
<a href="{{ route('center.month.filter') }}" class="btn btn-secondary mt-3"  style="margin-left: 88%;">Go Back</a>

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
