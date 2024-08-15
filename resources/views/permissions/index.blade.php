@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @can('permissions-create')
        <a href="{{ route('permissions.create') }}" class="btn btn-primary mb-3">Create New</a>
        @endcan
        @if ($data->isEmpty())
            <div class="alert alert-warning">No data available.</div>
            @if (Request::input('search'))
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary btn-sm mb-3">
                    <i class="bi bi-chevron-left"></i>
                    Back
                </a>
            @endif
        @else
            <div class="card mb-4">
                <div class="card-header">
                   <form action="{{ route('permissions.index') }}" method="get">
                     <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text" id="basic-addon1"><i
                                class="bi bi-search"></i></span>
                        <input type="search" name="search" value="{{ $search }}" class="form-control" placeholder="search permissions"
                            aria-label="search permissions" aria-describedby="button-addon2">
                        <button class="btn btn-outline-primary" type="submit"
                            id="button-addon2">Cari</button>
                    </div>
                   </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>name</th><th>guard_name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td><td>{{ $item->guard_name }}</td>
                                        <td>
                                            @can('permissions-edit')
                                            <a href="{{ route('permissions.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @endcan
                                            @can('permissions-delete')
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}">Delete</button>
                                            @endcan
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
                                                            <form action="{{ route('permissions.destroy', $item->id) }}" method="POST" style="display:inline;">
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
