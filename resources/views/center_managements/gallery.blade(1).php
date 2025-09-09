
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <h1 class="page-title">Gallery - {{ $center->center_name }}</h1>
        <a href="{{ url('center-managements') }}" class="btn btn-secondary float-end">Back</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header">Upload New File</div>
        <div class="card-body">
            <form method="POST" action="{{ route('center_managements.gallery.upload', $center->center_id) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label>File Name</label>
                    <input type="text" name="file_title" class="form-control" required>
                </div>

                <div class="form-group mb-3">
                    <label>Select File</label>
                    <input type="file" name="gallery_file" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Uploaded Files</div>
        <div class="card-body">
            @if(count($uploads))
                <ul class="list-group">
                    @foreach($uploads as $upload)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $upload['title'] }}
                            <a href="{{  asset('/public' . $upload['path']) }}" class="btn btn-sm btn-info" target="_blank">View</a>
                           
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No files uploaded yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection