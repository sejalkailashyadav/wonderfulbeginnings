@extends('layouts.app')

@section('content')

 <div class="container-fluid">

        <!-- PAGE HEADER -->
        <div class="page-header">
            <h1 class="page-title">Children Class: {{ $class->class_name }}</h1>
        </div>
<a href="https://erp.cocomelonlearning.com/class-masters" class="btn btn-secondary mb-3" style="margin-left: 88%;margin-right: -77px;">← Back to Class</a>
<br>
    @if($class->children->isEmpty())
        <p>No children enrolled in this class.</p>
    @else
        
<table class="table table-bordered">
    <thead class="table-light">
        <tr>
            <th>#</th>
            <th>Child  Name</th>
            <th>Parent  Name</th>
            <th>No. of Days</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($class->children as $child)
            <tr>
                <td>{{ $loop->iteration }}</td>
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
                <td>
                    @if ($child->status == 2)
                        <span class="badge bg-secondary">Withdrawn</span>
                    @else
                        <span class="badge bg-success">Active</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No children found for this class.</td>
            </tr>
        @endforelse
    </tbody>
</table>


    @endif

@endsection