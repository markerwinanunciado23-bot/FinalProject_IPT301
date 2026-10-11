
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h2 class="fw-bold">Dashboard</h2>
<p class="text-secondary">
    Overview of laboratory resources and activities.
</p>

<div class="row g-3 mb-4">

    @foreach([
        ['Laboratories', $laboratoryCount, 'laboratories.index'],
        ['Equipment', $equipmentCount, 'equipment.index'],
        ['Students', $studentCount, 'students.index'],
        ['Reservations', $reservationCount, 'reservations.index'],
        ['Maintenance', $maintenanceCount, 'maintenance.index']
    ] as $item)

        <div class="col-sm-6 col-xl">
            <a href="{{ route($item[2]) }}"
               class="text-reset text-decoration-none">

                <div class="card page-card">
                    <div class="card-body">
                        <div class="text-secondary">
                            {{ $item[0] }}
                        </div>

                        <h2 class="fw-bold text-primary">
                            {{ $item[1] }}
                        </h2>
                    </div>
                </div>

            </a>
        </div>

    @endforeach

</div>

<div class="card page-card">
    <div class="card-header bg-white fw-bold">
        Recent Reservations
    </div>

    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead>
                <tr>
                    <th>Student</th>
                    <th>Laboratory</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentReservations as $reservation)
                    <tr>
                        <td>
                            {{ $reservation->student->full_name }}
                        </td>

                        <td>
                            {{ $reservation->laboratory->name }}
                        </td>

                        <td>
                            {{ $reservation->reservation_date->format('M d, Y') }}
                        </td>

                        <td>
                            {{ $reservation->status }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-4">
                            No reservations yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
