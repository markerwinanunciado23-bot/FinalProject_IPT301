
@extends('layouts.app')

@section('title', 'Laboratories')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Laboratories</h2>
    <a href="{{ route('laboratories.create') }}" class="btn btn-primary">
        + Add Laboratory
    </a>
</div>

<div class="card page-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Building</th>
                    <th>Room</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laboratories as $laboratory)
                    <tr>
                        <td>{{ $laboratory->name }}</td>
                        <td>{{ $laboratory->building }}</td>
                        <td>{{ $laboratory->room_number }}</td>
                        <td>{{ $laboratory->capacity }}</td>
                        <td>{{ $laboratory->status }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('laboratories.show', $laboratory) }}"
                               class="btn btn-sm btn-outline-primary">View</a>

                            <a href="{{ route('laboratories.edit', $laboratory) }}"
                               class="btn btn-sm btn-outline-secondary">Edit</a>

                            <form action="{{ route('laboratories.destroy', $laboratory) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this laboratory?')">
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
                        <td colspan="6" class="text-center p-4">
                            No laboratories found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $laboratories->links() }}
    </div>
</div>
@endsection
