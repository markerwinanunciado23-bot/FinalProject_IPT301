
@extends('layouts.app')

@section('title', 'Equipment')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Equipment</h2>
    <a href="{{ route('equipment.create') }}" class="btn btn-primary">
        + Add Equipment
    </a>
</div>

<div class="card page-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Asset Code</th>
                    <th>Name</th>
                    <th>Laboratory</th>
                    <th>Quantity</th>
                    <th>Condition</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($equipment as $item)
                    <tr>
                        <td>{{ $item->asset_code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->laboratory->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->condition }}</td>
                        <td>{{ $item->status }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('equipment.show', $item) }}"
                               class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('equipment.edit', $item) }}"
                               class="btn btn-sm btn-outline-secondary">Edit</a>

                            <form action="{{ route('equipment.destroy', $item) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this equipment?')">
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
                            No equipment found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $equipment->links() }}
    </div>
</div>
@endsection
