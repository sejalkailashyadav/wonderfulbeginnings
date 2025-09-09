@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center p-3 mb-4 border-bottom bg-white shadow-sm"
         style="position: relative; z-index: 5;">
        <h1 class="h3 text-black fw-bold mb-0">
             Children Class: {{ $class->class_name }}
        </h1>
        <a href="https://erp.cocomelonlearning.com/class-masters" class="btn btn-secondary">
            <i class="fa fa-arrow-left me-1"></i> Back to Class
        </a>
    </div>

    <!-- CHILDREN LIST -->
    <div class="card shadow-sm border-0">
        <div class="card-header">
            <h5 class="mb-0 fw-bold"> Enrolled Children</h5>
        </div>
        <div class="card-body p-0">
            @if($class->children->isEmpty())
                <div class="p-4 text-center text-muted">
                    <i class="fa fa-info-circle me-1"></i> No children enrolled in this class.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-primary text-center">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th>Child Name</th>
                                <th>Parent Name</th>
                                <th>No. of Days</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($class->children as $child)
                                <tr>
                                    <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                    <td>{{ $child->child_first_name }} {{ $child->child_last_name }}</td>
                                    <td>{{ $child->parent_first_name }} {{ $child->parent_last_name }}</td>
                                    <td>
                                        @php
                                            $days = collect(json_decode($child->no_of_days, true))
                                                ->filter(fn($v) => $v == 1)
                                                ->keys();
                                        @endphp
                                        @foreach ($days as $day)
                                            <span class="badge bg-primary me-1">{{ $day }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        @if ($child->status == 2)
                                            <span class="badge bg-secondary">Withdrawn</span>
                                        @elseif($child->status == 0)
                                            <span class="badge bg-primary">Review</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
