@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Activity Log Details</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Log Name:</strong> {{ $data->log_name }}
                    </li>
                    <li class="list-group-item">
                        <strong>Description:</strong> {{ $data->description }}
                    </li>
                    <li class="list-group-item">
                        <strong>Subject Type:</strong> {{ $data->subject_type }}
                    </li>
                    <li class="list-group-item">
                        <strong>Event:</strong> {{ $data->event }}
                    </li>
                    <li class="list-group-item">
                        <strong>Subject ID:</strong> {{ $data->subject_id }}
                    </li>
                    <li class="list-group-item">
                        <strong>Causer Type:</strong> {{ $data->causer_type }}
                    </li>
                    <li class="list-group-item">
                        <strong>Causer ID:</strong> <b>{{ $user->name }}</b>
                    </li>
                    <li class="list-group-item">
                        <strong>Properties:</strong>
                        <code>
                            {{ $data->properties }}
                        </code>
                    </li>
                    <li class="list-group-item">
                        <strong>Batch UUID:</strong> {{ $data->batch_uuid }}
                    </li>
                    <li class="list-group-item">
                        <strong>Datetime:</strong> {{ $data->created_at }}
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <a href="{{ route('activity_log.index') }}" class="btn btn-secondary">Back</a>
            @can('activity_log-edit')
                <a href="{{ route('activity_log.edit', $data->id) }}" class="btn btn-warning">Edit</a>
            @endcan
            @can('activity_log-delete')
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $data->id }}">Delete</button>
            @endcan
            </div>
        </div>
        <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $data->id }}">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('activity_log.destroy', $data->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
