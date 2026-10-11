
@extends('layouts.app')

@section('title', 'Add Maintenance')

@section('content')
<h2 class="fw-bold mb-3">Add Maintenance Record</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('maintenance.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Equipment</label>
                <select name="equipment_id" class="form-select" required>
                    <option value="">Select equipment</option>
                    @foreach($equipment as $item)
                        <option value="{{ $item->id }}"
                            @selected(old('equipment_id') == $item->id)>
                            {{ $item->name }} ({{ $item->asset_code }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Reported Date</label>
                <input type="date" name="reported_date" class="form-control"
                       value="{{ old('reported_date', date('Y-m-d')) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Maintenance Type</label>
                <input name="maintenance_type" class="form-control"
                       value="{{ old('maintenance_type') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"
                          required>{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Assigned To</label>
                <input name="assigned_to" class="form-control"
                       value="{{ old('assigned_to') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Cost</label>
                <input type="number" name="cost" class="form-control"
                       min="0" step="0.01" value="{{ old('cost') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    @foreach(['Pending', 'In Progress', 'Completed'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', 'Pending') === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Completed Date (Optional)</label>
                <input type="date" name="completed_date" class="form-control"
                       value="{{ old('completed_date') }}">
            </div>

            <button class="btn btn-primary">Save Maintenance</button>
            <a href="{{ route('maintenance.index') }}"
               class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
