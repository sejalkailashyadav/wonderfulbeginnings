@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">Edit Fees Master</h1>
        </div>

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card custom-card">
                    <div class="card-header">
                        <h3 class="card-title">Edit Fees Information</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('fees-masters.update', $child->child_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <label>ACCB</label>
                            <input type="text" name="AACB" value="{{ $program->AACB ?? '' }}" class="form-control" />
                            <br><br>
                            <button type="submit">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection