
@extends('layouts.app')

@section('content')
<div class="container">
       <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Waiting List </h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
         
            </ol>
        </div>
   

    <form method="POST" action="{{ route('waiting-lists.update', $waiting_list->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Child/Children Names</label>
            <textarea name="child_names" class="form-control" required>{{ old('child_names', $waiting_list->child_names) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Date(s) of Birth</label>
            <textarea name="child_dobs" class="form-control" required>{{ old('child_dobs', $waiting_list->child_dobs) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Parent(s) Names</label>
            <input name="parent_names" class="form-control" value="{{ old('parent_names', $waiting_list->parent_names) }}" required>
        </div>

        <div class="mb-3">
            <label>Parent Contact Number</label>
            <input name="parent_contact" class="form-control" value="{{ old('parent_contact', $waiting_list->parent_contact) }}" required>
        </div>

        <div class="mb-3">
            <label>Requested Start Date</label>
            <input type="date" name="requested_start_date" class="form-control" value="{{ old('requested_start_date', $waiting_list->requested_start_date->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label>Looking for a Sibling Group?</label>
            <select name="sibling_group" class="form-control">
                <option value="0" {{ !$waiting_list->sibling_group ? 'selected' : '' }}>No</option>
                <option value="1" {{ $waiting_list->sibling_group ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Weekend Spot?</label>
            <select name="weekend_spot" class="form-control">
                <option value="0" {{ !$waiting_list->weekend_spot ? 'selected' : '' }}>No</option>
                <option value="1" {{ $waiting_list->weekend_spot ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Care Type</label>
            <select name="care_type" class="form-control" required>
                <option value="full-time" {{ $waiting_list->care_type === 'full-time' ? 'selected' : '' }}>Full-Time</option>
                <option value="part-time" {{ $waiting_list->care_type === 'part-time' ? 'selected' : '' }}>Part-Time</option>
            </select>
        </div>

        <!--<div class="mb-3">-->
        <!--    <label>Preferred Location</label>-->
        <!--    <input name="preferred_location" class="form-control" value="{{ old('preferred_location', $waiting_list->preferred_location) }}" required>-->
        <!--</div>-->
<div class="col-md-4">
                <label class="form-label">Center</label>
                <!--<select id="center_id" name="" class="form-control">-->
                <!--    <option value="">Select Center</option>-->
                <!--    @foreach($centers as $center)-->
                <!--        <option value="{{ $center->center_id }}" {{ old('center_id') == $center->center_id ? 'selected' : '' }}>{{ $center->center_name }}</option>-->
                <!--    @endforeach-->
                <!--</select>-->
                   <select id="center_id" name="preferred_location" class="form-control mb-3" >
                                    <option value="">Select Center</option>
                                    @foreach($centers as $center)
                                        <option value="{{ $center->center_id }}" 
                                            {{ old('center_id', $child->center_id ?? '') == $center->center_id ? 'selected' : '' }}>
                                            {{ $center->center_name }}
                                        </option>
                                    @endforeach
                                </select>
            </div>
          
                                
        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control">{{ old('notes', $waiting_list->notes) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label><br>
            <!--<label><input type="radio" name="status" value="requested" {{ $waiting_list->status === 'requested' ? 'checked' : '' }}> Requested</label>-->
            <label><input type="radio" name="status" value="confirmed" {{ $waiting_list->status === 'confirmed' ? 'checked' : '' }}> Confirmed</label>
            <label><input type="radio" name="status" value="cancelled" {{ $waiting_list->status === 'cancelled' ? 'checked' : '' }}> Cancelled</label>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
```

