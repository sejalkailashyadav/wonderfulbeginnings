@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Create Reports Master</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create Reports</li>
            </ol>
        </div>
        <!-- PAGE HEADER END -->

        <!-- FORM CARD -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">Reports Information</h3>
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

                        <form action="{{ url('fees-masters') }}" method="POST">
                            @csrf

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="center_id" class="form-label">Center Name <span
                                            class="text-danger">*</span></label>
                                    <select id="center" name="center_id" class="form-control">
                                        <option value="">Select Center</option>
                                        @foreach($centers as $center)
                                            <option value="{{ $center->center_id }}">{{ $center->center_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Program Dropdown -->
                                <div class="col-md-6 mb-3">
                                    <label for="Program_id" class="form-label">Program Name <span
                                            class="text-danger">*</span></label>
                                    <select id="program" name="Program_id" class="form-control">
                                        <option value="">Select Program</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="parent_fees" class="form-label">Parent Fees <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="parent_fees" class="form-control"
                                        placeholder="Enter Parent Fees value" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="CCFRI" class="form-label">CCFRI <span class="text-danger">*</span></label>
                                    <input type="number" name="CCFRI" class="form-control" placeholder="Enter CCFRI value"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="fees_amount" class="form-label">Fees Amount <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="fees_amount" class="form-control"
                                        placeholder="Enter total fees amount" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="number_of_days" class="form-label">Number of days <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="number_of_days" class="form-control"
                                        placeholder="Enter Number of days" required>
                                </div>

                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Create Reports</button>
                                <a href="{{ url('fees-masters') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $('#center').change(function () {
                                var centerId = $(this).val();

                                if (centerId) {
                                    $.ajax({
                                        url: '/get-programs/' + centerId,
                                        type: 'GET',
                                        success: function (data) {
                                            $('#program').empty();
                                            $('#program').append('<option value="">Select Program</option>');
                                            $.each(data, function (key, value) {
                                                $('#program').append('<option value="' + key + '">' + value + '</option>');
                                            });
                                        }
                                    });
                                } else {
                                    $('#program').empty().append('<option value="">Select Program</option>');
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- FORM CARD END -->

    </div>
@endsection