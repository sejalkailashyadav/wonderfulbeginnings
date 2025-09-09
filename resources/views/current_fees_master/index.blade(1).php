@extends('layouts.app')

@section('content')
<div class="container">
      <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Fees Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Center List</li>
            </ol>
        </div>
 
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('current-fees-master.create') }}" class="btn btn-primary mb-3" style="margin-left:90%">Add New Fees</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Center</th>
                <th>Fees Name</th>
                <th>Monthly Fees</th>
                <th>CCFRI</th>
                <th>Total</th>
                <th>Class</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fees as $fee)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fee->center->center_name ?? 'N/A' }}</td>
                    <td>{{ $fee->fees_name }}</td>
                    <td>${{ number_format($fee->monthly_fees, 2) }}</td>
                    <td>${{ number_format($fee->ccfri, 2) }}</td>
                    <td>${{ number_format($fee->total, 2) }}</td>
                    <td>{{ $fee->class->class_name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('current-fees-master.edit', $fee->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('current-fees-master.destroy', $fee->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this fee?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No fees records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
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




