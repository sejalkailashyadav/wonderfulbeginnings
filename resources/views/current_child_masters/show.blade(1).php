@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header">
            <h3 class="mb-0">Child Details</h3>
        </div>
        <div class="card-body">

            {{-- Profile Picture --}}
            @if ($child->child_picture)
                <div class="text-center mb-4">
                    <img src="{{ asset($child->child_picture) }}" width="100" class="rounded-circle shadow-sm">
                </div>
            @endif

            {{-- Status --}}
            <h5 class="text-primary border-bottom mt-4 pb-1">Status</h5>
            <p><strong>Status:</strong> 
                @php
                    $statuses = ['Review', 'Active', 'Withdrawal', 'Archive'];
                @endphp
                {{ $statuses[$child->status] ?? 'Unknown' }}
            </p>

            {{-- Center Info --}}
            <h5 class="text-primary border-bottom mt-4 pb-1">Center & Class</h5>
            <p><strong>Center:</strong> {{ $child->center->center_name ?? '-' }}</p>
            <p><strong>Class:</strong> {{ $child->class->class_name ?? '-' }}</p>
            <p><strong>Fees:</strong> {{ $child->fee->fees_name ?? '-' }}</p>


            {{-- Personal Info &  Parent Info --}}
            <h5 class="text-primary border-bottom pb-1">Personal  & Parent Information</h5>
            <p style="padding-left: 3px"><strong>Child Name:</strong> {{ $child->child_first_name }} {{ $child->child_last_name }}</p>
            <p><strong>Parent Name:</strong> {{ $child->parent_first_name }} {{ $child->parent_last_name }}</p>
            <p><strong>Email:</strong> {{ $child->parent_email }}</p>
            <p><strong>Mobile:</strong> {{ $child->parent_mobile }}</p>
        <p><strong>Health Card:</strong> {{ $child->child_dob ?? 'Not provided' }}</p>
         <p><strong>Health Card:</strong> {{ $child->health_card ?? 'Not provided' }}</p>
         
            {{-- Emergency Contacts --}}
            <h5 class="text-primary border-bottom mt-4 pb-1">Emergency Contacts</h5>
            <p><strong>Contact 1:</strong> {{ $child->emergency_contact_name }} | {{ $child->emergency_contact_number }} ({{ $child->emergency_contact_relations }})</p>
            <p><strong>Contact 2:</strong> {{ $child->emergency_contact_name2 }} | {{ $child->emergency_contact_number2 }} ({{ $child->emergency_contact_relation2 }})</p>
            <p><strong>Contact 3:</strong> {{ $child->emergency_contact_name3 }} | {{ $child->emergency_contact_number3 }} ({{ $child->emergency_contact_relation3 }})</p>

            {{-- Withdrawal Details --}}
            <h5 class="text-primary border-bottom mt-4 pb-1">Child Admission Details</h5>
            <p><strong>Withdrawal Last Date:</strong> {{ $child->withdrawal_date ?? '-' }}</p>
            <p><strong>Withdrawal Requested Date :</strong> {{ $child->withdrawal_requeste_date ?? '-' }}</p>
            <p><strong>Withdrawal Note:</strong> {{ $child->withdrawal_note ?? '-' }}</p>

            
            {{-- Sibling Info --}}
             <p><strong>Admission Date:</strong> {{ $child->admission_date }}</p>
            <p><strong>End Date:</strong> {{ $child->end_date ?? 'N/A' }}</p>
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

            {{-- Banking Info --}}
            <h5 class="text-primary border-bottom mt-4 pb-1">Banking Information</h5>
            <p><strong>Institution #:</strong> {{ $child->institution_number }}</p>
            <p><strong>Transit #:</strong> {{ $child->transit_number }}</p>
            <p><strong>Account #:</strong> {{ $child->account_number }}</p>



            {{-- Documents --}}
            <h5 class="text-primary border-bottom mt-4 pb-1">Documents</h5>
             <p><strong>Custody Agreement File:</strong> 
                @if ($child->custody_agreement)
                    <a href="{{ asset($child->custody_agreement) }}" target="_blank">View File</a>
                @else
                    Not uploaded
                @endif
            </p>
            <p><strong>Other Supporting Documents:</strong> 
                @php
                    $docs = json_decode($child->other_file_doc, true);
                @endphp
                @if (!empty($docs))
                    <ul class="mb-0">
                        @foreach ($docs as $doc)
                            <li><a href="{{ asset($doc) }}" target="_blank">{{ basename($doc) }}</a></li>
                        @endforeach
                    </ul>
                @else
                    <span>No documents uploaded</span>
                @endif
            </p>

            
            {{-- Actions --}}
            <hr>
            <a href="{{ route('current-child.edit', $child->child_id) }}" class="btn btn-primary me-2">Edit</a>

            <form action="{{ route('current-child.destroy', $child->child_id) }}" method="POST"
                style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this child?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Delete</button>
            </form>

        </div>
    </div>
</div>
@endsection
