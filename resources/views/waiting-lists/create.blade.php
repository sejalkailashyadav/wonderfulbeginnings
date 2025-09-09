@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
            style="margin-top: 150px; z-index: 5; position: relative;">
            <h1 class="h3 text-black fw-bold mb-0">Add to Waiting List</h1>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Waiting List Entry</li>
            </ol>
        </div>
        @php
            // Default status
            $status = 'Requested';

            // Check login
            $isLoggedIn = auth()->check();
            $user = session('user');

            // Flags
            $isAdminOrManager = $isLoggedIn && in_array($user->user_type, ['Admin', 'Manager']);
        @endphp
        <!-- FORM CARD -->
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold">Waiting List Information</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('waiting-lists.store') }}">
                            @csrf
                            <div class="row g-4">

                                <!-- CHILD INFORMATION SECTION -->
                                <div class="col-12">
                                    <h6 class="fw-bold text-primary border-bottom pb-2">Child Information</h6>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Child/Children Names <span
                                            class="text-danger">*</span></label>
                                    <textarea name="child_names" class="form-control" rows="2"
                                        required>{{ old('child_names') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Date(s) of Birth <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="child_dobs" class="form-control"
                                        value="{{ old('child_dobs') }}" required>
                                </div>

                                <!-- PARENT INFORMATION SECTION -->
                                <div class="col-12 pt-3">
                                    <h6 class="fw-bold text-primary border-bottom pb-2">Parent Information</h6>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Parent(s) Names <span
                                            class="text-danger">*</span></label>
                                    <input name="parent_names" class="form-control" value="{{ old('parent_names') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Parent Contact Number <span
                                            class="text-danger">*</span></label>
                                    <input name="parent_contact" class="form-control" value="{{ old('parent_contact') }}"
                                        required>
                                </div>

                                <!-- ADDITIONAL DETAILS SECTION -->
                                <div class="col-12 pt-3">
                                    <h6 class="fw-bold text-primary border-bottom pb-2">Additional Details</h6>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Requested Start Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="requested_start_date" class="form-control"
                                        value="{{ old('requested_start_date') }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Looking for a Sibling Group?</label>
                                    <select name="sibling_group" class="form-select">
                                        <option value="0" {{ old('sibling_group') == '0' ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('sibling_group') == '1' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Are you interested in a weekend spot for Saturday and
                                        Sunday? </label>
                                    <select name="weekend_spot" class="form-select">
                                        <option value="0" {{ old('weekend_spot') == '0' ? 'selected' : '' }}>No</option>
                                        <option value="1" {{ old('weekend_spot') == '1' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Care Type <span class="text-danger">*</span></label>
                                    <select name="care_type" class="form-select" required>
                                        <option value="full-time" {{ old('care_type') == 'full-time' ? 'selected' : '' }}>
                                            Full-Time</option>
                                        <option value="part-time" {{ old('care_type') == 'part-time' ? 'selected' : '' }}>
                                            Part-Time</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Preferred Location <span
                                            class="text-danger">*</span></label>
                                    <select id="center_id" name="preferred_location" class="form-select">
                                        <option value="">Select Center</option>
                                        @foreach($centers as $center)
                                            <option value="{{ $center->center_id }}" {{ old('preferred_location') == $center->center_id ? 'selected' : '' }}>
                                                {{ $center->center_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Notes -->
                                {{-- Notes Field --}}
                                <div class="mb-3">
                                    @if($user && ($user->user_type != 'Admin' || $user->user_type != 'Manager'))
                                        <label class="form-label fw-bold">Notes </label>
                                        <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>

                                    @else
                                        <label class="form-label fw-bold">Notes by User</label>
                                        <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>

                                    @endif
                                </div>




                                {{-- Status --}}
                                <div class="col-12">
                                    @if($user && ($user->user_type == 'Admin' || $user->user_type == 'Manager'))
                                        <label class="form-label fw-bold d-block">Status</label>

                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="status_requested" name="status" value="requested"
                                                class="form-check-input" {{ old('status', 'requested') == 'requested' ? 'checked' : '' }}>
                                            <label for="status_requested" class="form-check-label">Requested</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="status_confirmed" name="status" value="confirmed"
                                                class="form-check-input" {{ old('status') == 'confirmed' ? 'checked' : '' }}>
                                            <label for="status_confirmed" class="form-check-label">Confirmed</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="status_cancelled" name="status" value="cancelled"
                                                class="form-check-input" {{ old('status') == 'cancelled' ? 'checked' : '' }}>
                                            <label for="status_cancelled" class="form-check-label">Cancelled</label>
                                        </div>
                                    @else
                                        {{-- Hide status radios, force default = requested --}}
                                        <input type="hidden" name="status" value="requested">
                                    @endif
                                </div>


                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const centerDropdown = document.getElementById('center_id');
            centerDropdown.addEventListener('change', function () {
                const centerId = this.value;
                if (centerId) {
                    fetch(`/get-classes-by-center/${centerId}`)
                        .then(res => res.json())
                        .catch(err => console.error('Error fetching classes:', err));
                }
            });
        });
    </script>
@endsection