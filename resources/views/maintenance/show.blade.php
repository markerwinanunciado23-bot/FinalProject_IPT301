
@extends('layouts.app')

@section('title', 'View Maintenance')

@section('content')
<h2 class="fw-bold mb-3">Maintenance Details</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <p><strong>Equipment:</strong> {{ $record->equipment->name }}</p>
        <p><strong>Reported Date:</strong> {{ $record->reported_date->format('M d, Y') }}</p>
        <p><strong>Type:</strong> {{ $record->maintenance_type }}</p>
        <p><strong>Description:</strong> {{ $record->description }}</p>
        <p><strong>Assigned To:</strong> {{ $record->assigned_to ?: '—' }}</p>
        <p><strong>Cost:</strong> {{ $record->cost === null ? '—' : number_format((float) $record->cost, 2) }}</p>
        <p><strong>Status:</strong> {{ $record->status }}</p>
        <p><strong>Completed Date:</strong> {{ $record->completed_date?->format('M d, Y') ?? '—' }}</p>

        <a href="{{ route('maintenance.edit', $record) }}"
           class="btn btn-primary">Edit</a>
        <a href="{{ route('maintenance.index') }}"
           class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
