
@extends('layouts.app')

@section('title', 'Reservations')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Reservations</h2>
    <a href="{{ route('reservations.create') }}" class="btn btn-primary">
        + Add Reservation
    </a>
</div>

<div class="card page-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Laboratory</th>
                    <th>Equipment</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->student->full_name }}</td>
                        <td>{{ $reservation->laboratory->name }}</td>
                        <td>{{ $reservation->equipment?->name ?? '—' }}</td>
                        <td>{{ $reservation->reservation_date->format('M d, Y') }}</td>
                        <td>{{ $reservation->start_time }}–{{ $reservation->end_time }}</td>
                        <td>{{ $reservation->status }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('reservations.show', $reservation) }}"
                               class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('reservations.edit', $reservation) }}"
                               class="btn btn-sm btn-outline-secondary">Edit</a>

                            <form action="{{ route('reservations.destroy', $reservation) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this reservation?')">
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
                            No reservations found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $reservations->links() }}
    </div>
</div>
@endsection
