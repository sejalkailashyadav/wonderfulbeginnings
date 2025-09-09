@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- PAGE HEADER -->
    <div class="page-header">
        <h1 class="page-title">Create Program</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Program</li>
        </ol>
    </div>
    <!-- PAGE HEADER END -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- FORM CARD -->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card custom-card">
                <div class="card-header">
                    <h3 class="card-title">Program Information</h3>
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
                    <form action="{{ url('program-create') }}" method="POST">
                        @csrf
                        <div class="row">

                            <!-- Program Name -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Program Name <span class="text-danger">*</span></label>
                                <input type="text" name="program_name" class="form-control"
                                    placeholder="Enter program name" required>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Create Program</button>
                            <a href="{{ url('program-masters') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    <div id="messageBox" style="color: red; margin-top: 10px;margin-bottom:10px"></div>
                    <!-- Display all programs -->
                    <div class="mt-5">
                        <h4>All Programs</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Program Name</th>
                                    <th>delete </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($programs as $program)
                                    <tr>
                                        <td>{{ $program->prog_master_id }}</td>
                                        <!-- <td>{{ $program->program_name }}</td> -->
                                        <td contenteditable="true" data-id="{{ $program->prog_master_id }}"
                                            class="editable-program-name border p-1">
                                            {{ $program->program_name }}
                                        </td>

                                        <td>
                                            <form action="{{ route('program.destroy', $program->prog_master_id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this program?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.editable-program-name').on('blur', function () {
            var td = $(this);
            var newName = td.text().trim();
            var id = td.data('id');
            var messageBox = document.getElementById('messageBox');

            $.ajax({
                url: '/program-update/' + id,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    program_name: newName
                },
                success: function (response) {
                    if (response.success) {
                        messageBox.style.color = 'green';
                        messageBox.textContent = response.message || 'Update successful.';
                    } else {
                        messageBox.style.color = 'red';
                        messageBox.textContent = response.message || 'Update failed.';
                    }

                    setTimeout(() => {
                        messageBox.textContent = '';
                    }, 2000);
                },
                error: function (error) {
                    console.error('Error:', error);
                    messageBox.style.color = 'red';
                    messageBox.textContent = 'Something went wrong.';

                    setTimeout(() => {
                        messageBox.textContent = '';
                    }, 1000);
                }
            });
        });
    });
</script>