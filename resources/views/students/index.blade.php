
@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Students</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        + Add Student
    </a>
</div>

<div class="card page-card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                    <tr>
                        <td>{{ $student->student_number }}</td>
                        <td>{{ $student->full_name }}</td>
                        <td>{{ $student->course }}</td>
                        <td>{{ $student->year_level }}</td>
                        <td>{{ $student->email }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('students.show', $student) }}"
                               class="btn btn-sm btn-outline-primary">View</a>
                            <a href="{{ route('students.edit', $student) }}"
                               class="btn btn-sm btn-outline-secondary">Edit</a>

                            <form action="{{ route('students.destroy', $student) }}"
                                  method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this student?')">
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
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">
        {{ $students->links() }}
    </div>
</div>
@endsection
