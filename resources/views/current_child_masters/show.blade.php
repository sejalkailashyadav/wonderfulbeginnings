@extends('layouts.app')

@section('content')

<div class="container">
    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
        style="margin-top: 180px; position: relative; z-index: 5;">
        <h1 class="h4 text-black fw-bold mb-0">Child Details</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Child Details</li>
        </ol>
    </div>
    
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-white border-bottom">
        </div>
        <div class="card-body">
            
            @php
    $statuses = ['Review', 'Active', 'Withdrawal', 'Archive'];
    $statusLabel = $statuses[$child->status] ?? 'Unknown';
    $statusClass = match($statusLabel) {
        'Active' => 'success',
        'Withdrawal' => 'danger',
        'Archive' => 'secondary',
        'Review' => 'info',
        default => 'dark'
    };
@endphp

<div class="d-flex justify-content-between align-items-center mb-4 px-1">
    <h4 class="fw-bold m-0 text-capitalize">
        {{ $child->child_first_name }} {{ $child->child_last_name }}
    </h4>
    <span class="badge bg-{{ $statusClass }} fs-6 px-3 py-2">
        {{ $statusLabel }}
    </span>
</div>

            {{-- Profile Picture --}}
            @if ($child->child_picture)
                <div class="text-center mb-4">
                    <img src="{{ asset($child->child_picture) }}" width="120" class="rounded-circle shadow-sm border">
                </div>
            @endif

            <div class="row g-4">
                {{-- Status Section --}}
                <!--<div class="col-12">-->
                <!--    <h5 class="text-primary border-bottom pb-2">Status</h5>-->
                <!--    @php-->
                <!--        $statuses = ['Review', 'Active', 'Withdrawal', 'Archive'];-->
                <!--    @endphp-->
                <!--    <p><strong>Status:</strong> {{ $statuses[$child->status] ?? 'Unknown' }}</p>-->
                <!--</div>-->

                {{-- Center & Class Info --}}
                <div class="col-md-6">
                    <h5 class="text-primary border-bottom pb-2">Center & Class</h5>
                    <p><strong>Center:</strong> {{ $child->center->center_name ?? '-' }}</p>
                    <p><strong>Class:</strong> {{ $child->class->class_name ?? '-' }}</p>
                    <p><strong>Fees:</strong> {{ $child->fee->fees_name ?? '-' }}</p>
             @php
    $days = json_decode($child->no_of_days, true) ?? [];
    $activeDays = collect($days)
        ->filter(fn($v) => $v == 1)
        ->keys()
        ->implode(', ');
@endphp

<h5 class="text-primary border-bottom pb-2">Active Days</h5>
<p>{{ $activeDays ?: 'No Active Days' }}</p>


                </div>

                {{-- Personal & Parent Info --}}
                <div class="col-md-6">
                    <h5 class="text-primary border-bottom pb-2">Personal & Parent Info</h5>
                    <p><strong>Child Name:</strong> {{ $child->child_first_name }} {{ $child->child_last_name }}</p>
                    <p><strong>Parent Name:</strong> {{ $child->parent_first_name }} {{ $child->parent_last_name }}</p>
                    <p><strong>Email:</strong> {{ $child->parent_email }}</p>
                    <p><strong>Mobile:</strong> {{ $child->parent_mobile }}</p>
                    <p><strong>Date of Birth:</strong> {{ $child->child_dob ?? 'Not provided' }}</p>
                    <p><strong>Health Card:</strong> {{ $child->health_card ?? 'Not provided' }}</p>
                </div>

                {{-- Emergency Contacts --}}
                <div class="col-12">
                    <h5 class="text-primary border-bottom pb-2">Emergency Contacts</h5>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Contact 1:</strong> {{ $child->emergency_contact_name }} | {{ $child->emergency_contact_number }} ({{ $child->emergency_contact_relations }})
                        </li>
                        <li class="list-group-item">
                            <strong>Contact 2:</strong> {{ $child->emergency_contact_name2 }} | {{ $child->emergency_contact_number2 }} ({{ $child->emergency_contact_relation2 }})
                        </li>
                        <li class="list-group-item">
                            <strong>Contact 3:</strong> {{ $child->emergency_contact_name3 }} | {{ $child->emergency_contact_number3 }} ({{ $child->emergency_contact_relation3 }})
                        </li>
                    </ul>
                </div>

                

                {{-- Admission & Withdrawal --}}
                <div class="col-md-6">
                    <h5 class="text-primary border-bottom pb-2">Admission & Withdrawal</h5>
                    <p><strong>Admission Date:</strong> {{ $child->admission_date }}</p>
                    <p><strong>End Date:</strong> {{ $child->end_date ?? 'N/A' }}</p>
                    <p><strong>Withdrawal Date:</strong> {{ $child->withdrawal_date ?? '-' }}</p>
                    <p><strong>Requested Date:</strong> {{ $child->withdrawal_requeste_date ?? '-' }}</p>
                    <p><strong>Withdrawal Note:</strong> {{ $child->withdrawal_note ?? '-' }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="text-primary border-bottom pb-2">Sibling & Notes</h5>
                    <p><strong>Special Notes:</strong> {{ $child->special_notes ?? '-' }}</p>
                    <p><strong>Registration Fees Paid:</strong> {{ $child->registration_fees_paid ? 'Yes' : 'No' }}</p>
                    <p><strong>Is Sibling:</strong> {{ $child->issibling ? 'Yes' : 'No' }}
                        @if ($child->sibling_child_id)
                            |
                            @php
                                $sibling = \App\Models\CurrentChildMaster::find($child->sibling_child_id);
                            @endphp
                            {{ $sibling?->child_first_name }} {{ $sibling?->child_last_name }}
                        @else
                            | N/A
                        @endif
                    </p>
                </div>

                {{-- Banking Info --}}
                <div class="col-12">
                    <h5 class="text-primary border-bottom pb-2">Banking Information</h5>
                    <p><strong>Institution #:</strong> {{ $child->institution_number }}</p>
                    <p><strong>Transit #:</strong> {{ $child->transit_number }}</p>
                    <p><strong>Account #:</strong> {{ $child->account_number }}</p>
                </div>

                {{-- Documents --}}
                <div class="col-12">
                    <h5 class="text-primary border-bottom pb-2">Documents</h5>
                    <p><strong>Custody Agreement:</strong>
                        @if ($child->custody_agreement)
                            <a href="{{ asset($child->custody_agreement) }}" target="_blank">View File</a>
                        @else
                            Not uploaded
                        @endif
                    </p>
                    <p><strong>Supporting Documents:</strong>
                        @php
                            $docs = json_decode($child->other_file_doc, true);
                        @endphp
                        @if (!empty($docs))
                            <ul>
                                @foreach ($docs as $doc)
                                    <li><a href="{{ asset($doc) }}" target="_blank">{{ basename($doc) }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <span>No documents uploaded</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Actions --}}
            <hr>
            <div class="d-flex gap-2">
                <a href="{{ route('current-child.edit', $child->child_id) }}" class="btn btn-primary">Edit</a>
                <form action="{{ route('current-child.destroy', $child->child_id) }}" method="POST"
                style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this child?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>
            
            
            
            </div>

        </div>
    </div>
</div>
@endsection
