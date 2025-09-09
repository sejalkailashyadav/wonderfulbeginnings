@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap mb-4">
        <h1 class="page-title mb-2">Gallery - {{ $center->center_name }}</h1>
        <a href="{{ url('center-managements') }}" class="btn btn-secondary">Back</a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @php $user = session('user'); @endphp
    @if($user->user_type === 'Admin')
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Upload New File</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('center_managements.gallery.upload', $center->center_id) }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_title" class="form-label">File Name</label>
                            <input type="text" name="file_title" class="form-control" id="file_title" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gallery_file" class="form-label">Select File</label>
                            <input type="file" name="gallery_file" class="form-control" id="gallery_file" required>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Uploaded Files</h5>
        </div>
        <div class="card-body">
            @if(count($uploads))
            <div class="row g-3">
                @foreach($uploads as $upload)
                 <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column justify-content-between">

                            {{-- File Title --}}
                            <h6 class="card-title text-truncate mb-3" title="{{ $upload['title'] }}">
                                {{ $upload['title'] }}
                            </h6>

                            {{-- View Button --}}
                            <a href="{{ asset('/public' . $upload['path']) }}" 
                            class="btn btn-sm btn-primary mb-3 d-flex align-items-center justify-content-center"
                            target="_blank">
                                <i class="bi bi-eye me-2"></i> View
                            </a>

                            {{-- Replace File Form --}}
                            <form action="{{ route('center_managements.gallery.update', [$center->center_id, $loop->index]) }}" 
                                method="POST" enctype="multipart/form-data" class="mb-2">
                                @csrf
                                @method('PUT')

                                <input type="file" name="gallery_file" 
                                    class="form-control form-control-sm mb-2" required>

                                <button type="submit" class="btn btn-sm btn-info w-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-upload me-2"></i> Replace
                                </button>
                            </form>

                            {{-- Delete Form --}}
                            <form action="{{ route('center_managements.gallery.delete', [$center->center_id, $loop->index]) }}" 
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger w-100 d-flex align-items-center justify-content-center"
                                        onclick="return confirm('Are you sure you want to delete this file?')">
                                    <i class="bi bi-trash me-2"></i> Delete
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-muted">No files uploaded yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection