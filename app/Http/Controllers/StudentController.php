<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(10);

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $student = new Student();

        return view('students.create', compact('student'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_number' => 'required|string|max:50|unique:students,student_number',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'course' => 'required|string|max:120',
            'year_level' => 'required|integer|min:1|max:8',
            'email' => 'required|email|max:150|unique:students,email',
            'phone' => 'nullable|string|max:30',
        ]);

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Student added successfully.');
    }

    public function show(Student $student)
    {
        $student->load('reservations.laboratory');

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'student_number' => [
                'required', 'string', 'max:50',
                Rule::unique('students', 'student_number')->ignore($student->id),
            ],
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'course' => 'required|string|max:120',
            'year_level' => 'required|integer|min:1|max:8',
            'email' => [
                'required', 'email', 'max:150',
                Rule::unique('students', 'email')->ignore($student->id),
            ],
            'phone' => 'nullable|string|max:30',
        ]);

        $student->update($data);

        return redirect()->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        try {
            $student->delete();

            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully.');
        } catch (QueryException $e) {
            return back()->with(
                'error',
                'This student cannot be deleted because reservations exist.'
            );
        }
    }
}
