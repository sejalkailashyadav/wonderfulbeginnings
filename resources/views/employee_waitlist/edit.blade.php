@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Employee (Waitlist)</h2>
    <form action="{{ route('employee_waitlist.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('employee_waitlist.form', ['employee' => $employee])

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection