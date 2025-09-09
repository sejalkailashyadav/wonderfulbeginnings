@extends('layouts.app')

@section('content')
<div class="container">
       <div class="container-fluid">
        <div class="page-header">
            <h1 class="page-title">Waiting List</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
         
            </ol>
        </div>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('waiting-lists.create') }}" class="btn btn-primary mb-3">Add New</a>

    @if ($lists->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Child Name(s)</th>
                    <th>Parent(s)</th>
                    <th>Contact</th>
                    <th>Start Date</th>
                    <th>Status</th>
                    <th>Care Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lists as $list)
                    <tr>
                        <td>{{ $list->child_names }}</td>
                        <td>{{ $list->parent_names }}</td>
                        <td>{{ $list->parent_contact }}</td>
                        <td>{{ $list->requested_start_date->format('Y-m-d') }}</td>
                        <td>{{ ucfirst($list->status) }}</td>
                        <td>{{ ucfirst($list->care_type) }}</td>
                        <td>
                            <!--<a href="{{ route('waiting-lists.edit', $list->id) }}" class="btn btn-sm btn-warning">Edit</a>-->

                            <form action="{{ route('waiting-lists.destroy', $list->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Are you sure to delete this entry?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $lists->links() }}
    @else
        <p>No entries found.</p>
    @endif
</div>
@endsection
