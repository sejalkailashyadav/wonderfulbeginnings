
<div class="mb-3">
    <label>First Name</label>
    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name ?? '') }}" >
    @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    
</div>

<div class="mb-3">
    <label>Last Name</label>
    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name ?? '') }}" >
</div>

<div class="mb-3">
    <label>Designation</label>
    <select name="designation" class="form-select" >
        <option value="">Select</option>
        @foreach(['ECE','ECE-IT','ECE IT/SN','ECEA','RA','Management','General Administration'] as $role)
            <option value="{{ $role }}" {{ (old('designation', $employee->designation ?? '') == $role) ? 'selected' : '' }}>{{ $role }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Mobile Number</label>
    <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $employee->mobile_number ?? '') }}" >
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email ?? '') }}" >
</div>

<div class="mb-3">
    <label>Reference</label>
    <input type="text" name="reference" class="form-control" value="{{ old('reference', $employee->reference ?? '') }}" >
</div>

<div class="mb-3">
    <label>Expected Start Date</label>
    <input type="date" name="expected_start_date" class="form-control" value="{{ old('expected_start_date', $employee->expected_start_date ?? '') }}">
</div>

<div class="mb-3">
    <label>Resume (PDF)</label>
    <input type="file" name="resume" class="form-control">
    @if(!empty($employee->resume))
        <p class="mt-2">
            <a href="{{ asset($employee->resume) }}" target="_blank">View Uploaded Resume</a>
        </p>
    @endif
</div>

