@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Fees Record</h2>
  <div class="col-md-8 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">Fees Information</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
    <form method="POST" action="{{ route('current-fees-master.update', $fees->id) }}">
        @csrf

       <div class="mb-3">
    <label class="form-label">Center</label>
    <select name="center_id" id="center_id" class="form-control" required>
        <option value="">Select Center</option>
        @foreach($centers as $center)
            <option value="{{ $center->center_id }}" {{ $fees->center_id == $center->center_id ? 'selected' : '' }}>
                {{ $center->center_name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Class</label>
    <select name="class_id" id="class_id" class="form-control">
        <option value="">Select Class</option>
        @foreach($classes as $class)
            <option value="{{ $class->class_id }}" {{ $fees->class_id == $class->class_id ? 'selected' : '' }}>
                {{ $class->class_name }}
            </option>
        @endforeach
    </select>
</div>

        <div class="mb-3">
            <label class="form-label">Fees Name</label>
            <input type="text" name="fees_name" class="form-control" value="{{ $fees->fees_name }}" >
        </div>
@error('fees_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
        <div class="mb-3">
            <label class="form-label">Monthly Fees</label>
            <input type="number" name="monthly_fees" class="form-control" step="0.01" value="{{ $fees->monthly_fees }}" >
        </div>
@error('monthly_fees')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
        <div class="mb-3">
            <label class="form-label">CCFRI</label>
            <input type="number" name="ccfri" class="form-control" step="0.01" value="{{ $fees->ccfri }}" >
        </div>
@error('ccfri')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('current-fees-master.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script>
document.getElementById('center_id').addEventListener('change', function () {
    let centerId = this.value;
    fetch(`/get-classes-by-center/${centerId}`)
        .then(response => response.json())
        .then(data => {
            let classDropdown = document.getElementById('class_id');
            classDropdown.innerHTML = '<option value="">Select Class</option>';
            data.forEach(function (cls) {
                let option = document.createElement('option');
                option.value = cls.class_id;
                option.textContent = cls.class_name;
                classDropdown.appendChild(option);
            });
        });
});
</script>
@endsection
