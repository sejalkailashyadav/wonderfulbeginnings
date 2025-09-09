@extends('layouts.app')

@section('content')

<div class="container">
      <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Create Reports</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            
            </ol>
        </div>
   

    <form action="{{ route('center.month.filter.submit') }}" method="POST">

        @csrf

        <!-- Center Dropdown -->
        <div class="form-group mb-3">
            <label for="center_id">Select Center</label>
            <select id="center_id" name="center_id" class="form-control" required>
                <option value="">-- Select Center --</option>
                @foreach($centers as $center)
                    <option value="{{ $center->center_id }}">{{ $center->center_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Class Dropdown -->
        <div class="form-group mb-3">
            <label for="class_id">Select Class</label>
            <select id="class_id" name="class_id" class="form-control" >
                <option value="">-- Select Class --</option>
            </select>
        </div>

        <!-- Month Picker -->
        <div class="form-group mb-3">
            <label for="report_month">Select Month</label>
            <input type="month" name="report_month" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Show Children</button>
    </form>
</div>

<!-- AJAX Script to Load Classes -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#center_id').on('change', function () {
        var centerId = $(this).val();
        $('#class_id').html('<option value="">Loading...</option>');

        $.ajax({
            url: '/get-classes-by-center/' + centerId,
            method: 'GET',
            success: function (data) {
                let classSelect = $('#class_id');
                classSelect.empty().append('<option value="">Select All Class</option>');
                data.forEach(function (cls) {
                    classSelect.append('<option value="' + cls.class_id + '">' + cls.class_name + '</option>');
                });
            }
        });
    });
</script>
@endsection
