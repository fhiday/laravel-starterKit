@extends('layouts.app')

@section('content')
    <div class="container">
       
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('activity_log.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3"><label for="log_name" class="form-label">Log_name</label><input type="text" name="log_name" id="log_name" class="form-control" value="{{ $data->log_name }}" required></div><div class="mb-3"><label for="description" class="form-label">Description</label><input type="text" name="description" id="description" class="form-control" value="{{ $data->description }}" required></div><div class="mb-3"><label for="subject_type" class="form-label">Subject_type</label><input type="text" name="subject_type" id="subject_type" class="form-control" value="{{ $data->subject_type }}" required></div><div class="mb-3"><label for="event" class="form-label">Event</label><input type="text" name="event" id="event" class="form-control" value="{{ $data->event }}" required></div><div class="mb-3"><label for="subject_id" class="form-label">Subject_id</label><input type="text" name="subject_id" id="subject_id" class="form-control" value="{{ $data->subject_id }}" required></div><div class="mb-3"><label for="causer_type" class="form-label">Causer_type</label><input type="text" name="causer_type" id="causer_type" class="form-control" value="{{ $data->causer_type }}" required></div><div class="mb-3"><label for="causer_id" class="form-label">Causer_id</label><input type="text" name="causer_id" id="causer_id" class="form-control" value="{{ $data->causer_id }}" required></div><div class="mb-3"><label for="properties" class="form-label">Properties</label><input type="text" name="properties" id="properties" class="form-control" value="{{ $data->properties }}" required></div><div class="mb-3"><label for="batch_uuid" class="form-label">Batch_uuid</label><input type="text" name="batch_uuid" id="batch_uuid" class="form-control" value="{{ $data->batch_uuid }}" required></div>
                    <a href="{{ route('activity_log.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
