
@extends('layouts.app')

@section('title', 'Add Laboratory')

@section('content')
<h2 class="fw-bold mb-3">Add Laboratory</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('laboratories.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Laboratory Name</label>
                <input name="name" class="form-control"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Building</label>
                <input name="building" class="form-control"
                       value="{{ old('building') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Room Number</label>
                <input name="room_number" class="form-control"
                       value="{{ old('room_number') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Capacity</label>
                <input type="number" min="1" name="capacity"
                       class="form-control" value="{{ old('capacity') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control"
                          rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    @foreach(['Available', 'Unavailable', 'Under Maintenance'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', 'Available') === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Save Laboratory</button>
            <a href="{{ route('laboratories.index') }}"
               class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
