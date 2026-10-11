<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laboratory;
use App\Models\Equipment;
use App\Models\Student;
use App\Models\Reservation;
use App\Models\Maintenance;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $labs = collect();

        foreach ([
            [
                'name' => 'Computer Laboratory 1',
                'building' => 'Main Building',
                'room_number' => '101',
                'capacity' => 40,
            ],
            [
                'name' => 'Networking Laboratory',
                'building' => 'Technology Building',
                'room_number' => '202',
                'capacity' => 30,
            ],
            [
                'name' => 'Electronics Laboratory',
                'building' => 'Science Building',
                'room_number' => '303',
                'capacity' => 25,
            ],
        ] as $data) {
            $labs->push(Laboratory::create($data + [
                'description' => 'School laboratory for practical activities.',
                'status' => 'Available',
            ]));
        }

        foreach ($labs as $index => $lab) {
            Equipment::create([
                'laboratory_id' => $lab->id,
                'name' => 'Desktop Computer ' . ($index + 1),
                'asset_code' => 'AST-1000' . ($index + 1),
                'category' => 'Computer Equipment',
                'quantity' => 20,
                'condition' => 'Good',
                'status' => 'Available',
            ]);
        }

        $students = collect();

        foreach ([
            ['STU-1001', 'Juan', 'Dela Cruz', 'juan@example.com'],
            ['STU-1002', 'Maria', 'Santos', 'maria@example.com'],
            ['STU-1003', 'Pedro', 'Reyes', 'pedro@example.com'],
        ] as [$number, $first, $last, $email]) {
            $students->push(Student::create([
                'student_number' => $number,
                'first_name' => $first,
                'last_name' => $last,
                'course' => 'BSIT',
                'year_level' => 3,
                'email' => $email,
            ]));
        }

        $firstEquipment = Equipment::first();

        Reservation::create([
            'student_id' => $students->first()->id,
            'laboratory_id' => $labs->first()->id,
            'equipment_id' => $firstEquipment->id,
            'reservation_date' => now()->addDay()->toDateString(),
            'start_time' => '09:00',
            'end_time' => '10:00',
            'purpose' => 'Programming laboratory activity',
            'status' => 'Pending',
            'remarks' => 'Sample reservation',
        ]);

        Maintenance::create([
            'equipment_id' => $firstEquipment->id,
            'reported_date' => now()->toDateString(),
            'maintenance_type' => 'Inspection',
            'description' => 'Routine equipment inspection.',
            'assigned_to' => 'Laboratory Technician',
            'cost' => 0,
            'status' => 'Pending',
        ]);
    }
}
