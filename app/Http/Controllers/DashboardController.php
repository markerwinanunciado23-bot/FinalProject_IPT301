<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Equipment;
use App\Models\Student;
use App\Models\Reservation;
use App\Models\Maintenance;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'laboratoryCount' => Laboratory::count(),
            'equipmentCount' => Equipment::count(),
            'studentCount' => Student::count(),
            'reservationCount' => Reservation::count(),
            'maintenanceCount' => Maintenance::count(),

            'recentReservations' => Reservation::with([
                'student',
                'laboratory'
            ])->latest()->take(5)->get(),
        ]);
    }
}
