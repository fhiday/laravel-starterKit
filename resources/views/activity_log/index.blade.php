@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between mb-3">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @can('activity_log-create')
                <a href="{{ route('activity_log.create') }}" class="btn btn-primary">Create New</a>
            @endcan
        </div>

        @if ($data->isEmpty())
            <div class="alert alert-warning">No data available.</div>
        @else
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Activity Log</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Log Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Subject Type</th>
                                    <th scope="col">Event</th>
                                    <th scope="col">Causer Type</th>
                                    <th scope="col">Causer ID</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->log_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->subject_type }}</td>
                                        <td>{{ $item->event }}</td>
                                        <td>{{ $item->causer_type }}</td>
                                        <td>{{ $item->name." (".$item->causer_id.")" }}</td>
                                        <td>
                                           <div class="btn-group btn-group-sm">
                                             <a href="{{ route('activity_log.show', $item->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                                            @can('activity_log-edit')
                                                <a href="{{ route('activity_log.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            @endcan
                                            @can('activity_log-delete')
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                                            @endcan
                                           </div>
                                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Confirm Delete</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Are you sure you want to delete this item?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <form action="{{ route('activity_log.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>
@endsection
