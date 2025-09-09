@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
         style="margin-top: 150px; z-index: 5; position: relative;">
        <h1 class="h3 text-black fw-bold mb-0">Edit Waiting List</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Waiting List</li>
        </ol>
    </div>

    <!-- FORM CARD -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0 fw-bold"> Waiting List Information</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('waiting-lists.update', $waiting_list->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">

                            <!-- CHILD INFO -->
                            <div class="col-12">
                                <h6 class="fw-bold text-primary border-bottom pb-2">Child Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Child/Children Names <span class="text-danger">*</span></label>
                                <textarea name="child_names" class="form-control" rows="2" required>{{ old('child_names', $waiting_list->child_names) }}</textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Date(s) of Birth <span class="text-danger">*</span></label>
                                <textarea name="child_dobs" class="form-control" rows="2" required>{{ old('child_dobs', $waiting_list->child_dobs) }}</textarea>
                            </div>

                            <!-- PARENT INFO -->
                            <div class="col-12 pt-3">
                                <h6 class="fw-bold text-primary border-bottom pb-2">Parent Information</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Parent(s) Names <span class="text-danger">*</span></label>
                                <input name="parent_names" class="form-control" value="{{ old('parent_names', $waiting_list->parent_names) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Parent Contact Number <span class="text-danger">*</span></label>
                                <input name="parent_contact" class="form-control" value="{{ old('parent_contact', $waiting_list->parent_contact) }}" required>
                            </div>

                            <!-- OTHER DETAILS -->
                            <div class="col-12 pt-3">
                                <h6 class="fw-bold text-primary border-bottom pb-2">Other Details</h6>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Requested Start Date <span class="text-danger">*</span></label>
                                <input type="date" name="requested_start_date" class="form-control" value="{{ old('requested_start_date', $waiting_list->requested_start_date->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Looking for a Sibling Group?</label>
                                <select name="sibling_group" class="form-select">
                                    <option value="0" {{ !$waiting_list->sibling_group ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $waiting_list->sibling_group ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Are you interested in a weekend spot for Saturday and Sunday? </label>
                                <select name="weekend_spot" class="form-select">
                                    <option value="0" {{ !$waiting_list->weekend_spot ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ $waiting_list->weekend_spot ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Care Type <span class="text-danger">*</span></label>
                                <select name="care_type" class="form-select" required>
                                    <option value="full-time" {{ $waiting_list->care_type === 'full-time' ? 'selected' : '' }}>Full-Time</option>
                                    <option value="part-time" {{ $waiting_list->care_type === 'part-time' ? 'selected' : '' }}>Part-Time</option>
                                </select>
                            </div>

                            <!-- PREFERRED LOCATION -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Preferred Location <span class="text-danger">*</span></label>
                                <select id="center_id" name="preferred_location" class="form-select">
                                    <option value="">Select Center</option>
                                    @foreach($centers as $center)
                                        <option value="{{ $center->center_id }}" 
                                            {{ old('center_id', $child->center_id ?? '') == $center->center_id ? 'selected' : '' }}>
                                            {{ $center->center_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- NOTES -->
                            <div class="col-12">
                                  @if($user && ($user->user_type != 'Admin' || $user->user_type != 'Manager'))
                                        <label class="form-label fw-bold">Notes </label>
                                        <textarea name="notes" class="form-control" rows="2">{{ old('notes', $waiting_list->notes) }}</textarea>
                                    @else
                                <label class="form-label fw-bold">Notes by User</label>
                                    <textarea name="notes" class="form-control" rows="2">{{ old('notes', $waiting_list->notes) }}</textarea>
                                    @endif
                            </div>

                            <!-- STATUS -->
                           {{-- Status (Edit Form) --}}
            <div class="col-12">
        @if($user && ($user->user_type == 'Admin' || $user->user_type == 'Manager'))
            <label class="form-label fw-bold d-block">Status</label>
    
            <div class="form-check form-check-inline">
                <input type="radio" id="status_requested" name="status" value="requested" class="form-check-input"
                    {{ $waiting_list->status === 'requested' ? 'checked' : '' }}>
                <label for="status_requested" class="form-check-label">Requested</label>
            </div>
    
            <div class="form-check form-check-inline">
                <input type="radio" id="status_confirmed" name="status" value="confirmed" class="form-check-input"
                    {{ $waiting_list->status === 'confirmed' ? 'checked' : '' }}>
                <label for="status_confirmed" class="form-check-label">Confirmed</label>
            </div>
    
            <div class="form-check form-check-inline">
                <input type="radio" id="status_cancelled" name="status" value="cancelled" class="form-check-input"
                    {{ $waiting_list->status === 'cancelled' ? 'checked' : '' }}>
                <label for="status_cancelled" class="form-check-label">Cancelled</label>
            </div>
        @else
            {{-- Non-admin users: hide status, but keep value --}}
            <input type="hidden" name="status" value="{{ $waiting_list->status ?? 'requested' }}">
        @endif
    </div>

                        </div>

                        <!-- SUBMIT -->
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save me-1"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
