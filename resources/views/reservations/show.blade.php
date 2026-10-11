
@extends('layouts.app')

@section('title', 'View Reservation')

@section('content')
<h2 class="fw-bold mb-3">Reservation Details</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <p><strong>Student:</strong> {{ $reservation->student->full_name }}</p>
        <p><strong>Laboratory:</strong> {{ $reservation->laboratory->name }}</p>
        <p><strong>Equipment:</strong> {{ $reservation->equipment?->name ?? '—' }}</p>
        <p><strong>Date:</strong> {{ $reservation->reservation_date->format('M d, Y') }}</p>
        <p><strong>Start Time:</strong> {{ $reservation->start_time }}</p>
        <p><strong>End Time:</strong> {{ $reservation->end_time }}</p>
        <p><strong>Purpose:</strong> {{ $reservation->purpose }}</p>
        <p><strong>Status:</strong> {{ $reservation->status }}</p>
        <p><strong>Remarks:</strong> {{ $reservation->remarks ?: '—' }}</p>

        <a href="{{ route('reservations.edit', $reservation) }}"
           class="btn btn-primary">Edit</a>
        <a href="{{ route('reservations.index') }}"
           class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
