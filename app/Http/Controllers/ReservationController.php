<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Student;
use App\Models\Laboratory;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with([
            'student', 'laboratory', 'equipment'
        ])->latest()->paginate(10);

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $reservation = new Reservation();

        return view('reservations.create', [
            'reservation' => $reservation,
            'students' => Student::orderBy('last_name')->get(),
            'laboratories' => Laboratory::orderBy('name')->get(),
            'equipment' => Equipment::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'laboratory_id' => 'required|exists:laboratories,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'purpose' => 'required|string|max:1000',
            'status' => 'required|in:Pending,Approved,Rejected,Completed,Cancelled',
            'remarks' => 'nullable|string|max:1000',
        ]);

        Reservation::create($data);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation added successfully.');
    }

    public function show(Reservation $reservation)
    {
        $reservation->load('student', 'laboratory', 'equipment');

        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        return view('reservations.edit', [
            'reservation' => $reservation,
            'students' => Student::orderBy('last_name')->get(),
            'laboratories' => Laboratory::orderBy('name')->get(),
            'equipment' => Equipment::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'laboratory_id' => 'required|exists:laboratories,id',
            'equipment_id' => 'nullable|exists:equipment,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'purpose' => 'required|string|max:1000',
            'status' => 'required|in:Pending,Approved,Rejected,Completed,Cancelled',
            'remarks' => 'nullable|string|max:1000',
        ]);

        $reservation->update($data);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully.');
    }

    public function destroy(Reservation $reservation)
    {
        try {
            $reservation->delete();

            return redirect()->route('reservations.index')
                ->with('success', 'Reservation deleted successfully.');
        } catch (QueryException $e) {
            return back()->with(
                'error',
                'Unable to delete this reservation.'
            );
        }
    }
}
