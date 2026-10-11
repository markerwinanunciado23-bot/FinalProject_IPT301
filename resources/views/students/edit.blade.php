
@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
<h2 class="fw-bold mb-3">Edit Student</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <form method="POST"
              action="{{ route('students.update', $student) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Student Number</label>
                <input name="student_number" class="form-control"
                       value="{{ old('student_number', $student->student_number) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">First Name</label>
                <input name="first_name" class="form-control"
                       value="{{ old('first_name', $student->first_name) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name</label>
                <input name="last_name" class="form-control"
                       value="{{ old('last_name', $student->last_name) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Course</label>
                <input name="course" class="form-control"
                       value="{{ old('course', $student->course) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Year Level</label>
                <select name="year_level" class="form-select" required>
                    @foreach([1, 2, 3, 4] as $year)
                        <option value="{{ $year }}"
                            @selected(old('year_level', $student->year_level) == $year)>
                            Year {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $student->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input name="phone" class="form-control"
                       value="{{ old('phone', $student->phone) }}">
            </div>

            <button class="btn btn-primary">Update Student</button>
            <a href="{{ route('students.index') }}"
               class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
