
@extends('layouts.app')

@section('title', 'View Student')

@section('content')
<h2 class="fw-bold mb-3">Student Details</h2>

<div class="card page-card">
    <div class="card-body p-4">
        <p><strong>Student Number:</strong> {{ $student->student_number }}</p>
        <p><strong>First Name:</strong> {{ $student->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $student->last_name }}</p>
        <p><strong>Course:</strong> {{ $student->course }}</p>
        <p><strong>Year Level:</strong> {{ $student->year_level }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>
        <p><strong>Phone:</strong> {{ $student->phone ?: '—' }}</p>

        <a href="{{ route('students.edit', $student) }}"
           class="btn btn-primary">Edit</a>
        <a href="{{ route('students.index') }}"
           class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
