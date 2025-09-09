@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-5 border-bottom bg-white shadow-sm"
         style=" z-index: 5; position: relative;">
        <h1 class="h3 text-primary fw-bold mb-0">Waiting List</h1>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Waiting List</li>
            
        </ol>
    </div>

    <!-- SUCCESS MESSAGE -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
<br><br><br><br>
    <!-- ACTION BUTTON -->
    <div class="mb-3">
        <a href="{{ route('waiting-lists.create') }}" class="btn btn-primary">
            <i class="fa fa-plus me-1"></i> Add New
        </a>
    </div>
    
     <h5>
  <a href="#" 
     onclick="navigator.clipboard.writeText('https://shorturl.at/fWHLB'); alert('Link copied to clipboard!'); return false;" 
     style="text-decoration:none; display:flex; align-items:center; gap:6px;color:blue">
     
    Public Link 
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
      <path d="M10 1.5v1h1.5A1.5 1.5 0 0 1 13 4v9a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 13V4a1.5 1.5 0 0 1 1.5-1.5H6v-1A1.5 1.5 0 0 1 7.5 0h1A1.5 1.5 0 0 1 10 1.5zM6 2.5v-1h4v1H6z"/>
    </svg>
  </a>
</h5>

    <!-- LIST TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            @if ($lists->count())
                <div class="table-responsive">
                   

                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Child Name(s)</th>
                                <th>Parent(s)</th>
                                <th>Contact</th>
                                <th>Start Date</th>
                                <th>Status</th>
                                <th>Care Type</th>
                                <!--<th>Created at</th>-->
                                <th class="text-center" style="width: 150px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                                <tr>
                                    <td>{{ $list->child_names }}</td>
                                    <td>{{ $list->parent_names }}</td>
                                    <td>{{ $list->parent_contact }}</td>
                                    <td>{{ $list->requested_start_date->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $list->status === 'confirmed' ? 'success' : ($list->status === 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($list->status) }}
                                        </span>
                                    </td>
                                    <td>{{ ucfirst($list->care_type) }}</td>
                                     <!--<td>{{ ucfirst($list->created_at) }}</td>-->
                                    <td class="text-center">
                                        <!--<a href="{{ route('waiting-lists.edit', $list->id) }}" class="btn btn-sm btn-warning me-1">-->
                                        <!--    <i class="fa fa-edit"></i>-->
                                        <!--</a>-->
                                        <form action="{{ route('waiting-lists.destroy', $list->id) }}" method="POST"
                                              style="display:inline-block" onsubmit="return confirm('Are you sure to delete this entry?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                 {{ $lists->links() }}
            @else
                <div class="p-4 text-center text-muted">
                    <i class="fa fa-info-circle me-1"></i> No entries found.
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
