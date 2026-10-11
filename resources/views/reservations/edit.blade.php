
@extends('layouts.app')

@section('title', 'Edit Reservation')

@section('content')
<h2 class="fw-bold mb-3">Edit Reservation</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <form method="POST"
              action="{{ route('reservations.update', $reservation) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Student</label>
                <select name="student_id" class="form-select" required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}"
                            @selected(old('student_id', $reservation->student_id) == $student->id)>
                            {{ $student->student_number }} - {{ $student->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Laboratory</label>
                <select name="laboratory_id" class="form-select" required>
                    @foreach($laboratories as $laboratory)
                        <option value="{{ $laboratory->id }}"
                            @selected(old('laboratory_id', $reservation->laboratory_id) == $laboratory->id)>
                            {{ $laboratory->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Equipment (Optional)</label>
                <select name="equipment_id" class="form-select">
                    <option value="">No specific equipment</option>
                    @foreach($equipment as $item)
                        <option value="{{ $item->id }}"
                            @selected(old('equipment_id', $reservation->equipment_id) == $item->id)>
                            {{ $item->name }} ({{ $item->asset_code }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Reservation Date</label>
                <input type="date" name="reservation_date" class="form-control"
                       value="{{ old('reservation_date', $reservation->reservation_date?->format('Y-m-d')) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Start Time</label>
                <input type="time" name="start_time" class="form-control"
                       value="{{ old('start_time', substr($reservation->start_time ?? '', 0, 5)) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">End Time</label>
                <input type="time" name="end_time" class="form-control"
                       value="{{ old('end_time', substr($reservation->end_time ?? '', 0, 5)) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Purpose</label>
                <textarea name="purpose" class="form-control" rows="3"
                          required>{{ old('purpose', $reservation->purpose) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    @foreach(['Pending', 'Approved', 'Rejected', 'Completed', 'Cancelled'] as $status)
                        <option value="{{ $status }}"
                            @selected(old('status', $reservation->status) === $status)>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Remarks</label>
                <textarea name="remarks" class="form-control"
                          rows="2">{{ old('remarks', $reservation->remarks) }}</textarea>
            </div>

            <button class="btn btn-primary">Update Reservation</button>
            <a href="{{ route('reservations.index') }}"
               class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
