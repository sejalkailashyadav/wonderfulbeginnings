@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-5 border-bottom bg-white shadow-sm"
         style=" z-index: 5; position: relative;">
        <h1 class="h3 text-primary fw-bold mb-0">Manager List</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manager List</li>
        </ol>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- ACTION BUTTON -->
    <div class="mb-3">
        <a href="{{ route('create-manger.create') }}" class="btn btn-primary">
            <i class="fa fa-plus me-1"></i> Add New
        </a>
    </div>

    <!-- LIST TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @if ($lists->count())
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th> Username</th>
                                <th>Password</th>
                                <th>Center</th>
                                <!--<th>Created at</th>-->
                                <!--<th class="text-center" style="width: 150px;">Actions</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>{{ $list->user_name }}</td>
                                    <td>{{ $list->password }}</td>
                                    <td>{{ $list->center->center_name }}</td>
                                     <!--<td>{{ ucfirst($list->created_at) }}</td>-->
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- PAGINATION -->
                <div class="p-3">
                    {{ $lists->links() }}
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    <i class="fa fa-info-circle me-1"></i> No entries found.
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
