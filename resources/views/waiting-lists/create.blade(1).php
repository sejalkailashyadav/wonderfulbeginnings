
@extends('layouts.app')

@section('content')
<br><br>
<div class="container">
    <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">Add to Waiting List</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
         
            </ol>
        </div>


    <form method="POST" action="{{ route('waiting-lists.store') }}">
        @csrf

        <div class="mb-3">
            <label>Child/Children Names</label>
            <textarea name="child_names" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Date(s) of Birth</label>
            <input type="date" name="child_dobs" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Parent(s) Names</label>
            <input name="parent_names" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Parent Contact Number</label>
            <input name="parent_contact" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Requested Start Date</label>
            <input type="date" name="requested_start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Looking for a Sibling Group?</label>
            <select name="sibling_group" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Weekend Spot?</label>
            <select name="weekend_spot" class="form-control">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Care Type</label>
            <select name="care_type" class="form-control" required>
                <option value="full-time">Full-Time</option>
                <option value="part-time">Part-Time</option>
            </select>
        </div>

        <!--<div class="mb-3">-->
        <!--    <label>Preferred Location</label>-->
        <!--    <input name="preferred_location" class="form-control" required>-->
        <!--</div>-->
          <div class="col-md-4">
                <label class="form-label">Center</label>
                <select id="center_id" name="preferred_location" class="form-control">
                    <option value="">Select Center</option>
                    @foreach($centers as $center)
                        <option value="{{ $center->center_id }}" {{ old('center_id') == $center->center_id ? 'selected' : '' }}>{{ $center->center_name }}</option>
                    @endforeach
                </select>
            </div>

        <div class="mb-3">
            <label>Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <div class="mb-3" >
            <label>Status</label><br>
            <label><input type="radio" name="status" value="requested" checked> Requested</label>
            <label><input type="radio" name="status" value="confirmed"> Confirmed</label>
            <label><input type="radio" name="status" value="cancelled"> Cancelled</label>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br><br>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const centerDropdown = document.getElementById('center_id');
  
    // Handle center selection
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