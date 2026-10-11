
@extends('layouts.app')

@section('title', 'Maintenance')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Maintenance</h2>
    <a href="{{ route('maintenance.create') }}" class="btn btn-primary">
        + Add Maintenance
    </a>
</div>

<div class="card page-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Equipment</th>
                    <th>Reported Date</th>
                    <th>Type</th>
                    <th>Assigned To</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maintenanceRecords as $record)
                    <tr>
                        <td>{{ $record->equipment->name }}</td>
                        <td>{{ $record->reported_date->format('M d, Y') }}</td>
                        <td>{{ $record->maintenance_type }}</td>
                        <td>{{ $record->assigned_to ?: '—' }}</td>
                        <td>{{ $record->cost === null ? '—' : number_format((float) $record->cost, 2) }}</td>
                        <td>{{ $record->status }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('maintenance.show', $record) }}"
                               class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('maintenance.edit', $record) }}"
                               class="btn btn-sm btn-outline-secondary">Edit</a>

                            <form action="{{ route('maintenance.destroy', $record) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this maintenance record?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center p-4">
                            No maintenance records found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $maintenanceRecords->links() }}
    </div>
</div>
@endsection
