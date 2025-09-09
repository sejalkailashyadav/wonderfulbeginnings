@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Notification Details</h1>

    <div class="card">
        <div class="card-body">
            <!--<p><strong>ID:</strong> {{ $notification->id }}</p>-->
            <p><strong>Type:</strong> {{ $notification->type }}</p>
            <p><strong>Notifiable:</strong> {{ $notification->notifiable_type }} ({{ $notification->notifiable_id }})</p>
            <p><strong>Status:</strong> {{ $notification->read_at ? 'Read at '.$notification->read_at : 'Unread' }}</p>
            <p><strong>Created At:</strong> {{ $notification->created_at->format('d-m-Y H:i') }}</p>

            <hr>
            <h5>Data</h5>
            <ul>
                <!--<li><b>Child ID:</b> {{ $notification->data['child_id'] ?? '-' }}</li>-->
                <li><b>Child Name:</b> {{ $notification->data['child_name'] ?? '-' }}</li>
                <li><b>Action:</b> {{ ucfirst($notification->data['action'] ?? '-') }}</li>
                <li><b>By User:</b> {{ $notification->data['by_user'] ?? 'System' }}</li>
                <li><b>Center ID:</b> {{ $notification->data['center_id'] ?? '-' }}</li>
            </ul>
        </div>
    </div>

    <a href="{{ route('notifications.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
