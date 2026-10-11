<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'laboratory_id',
        'equipment_id',
        'reservation_date',
        'start_time',
        'end_time',
        'purpose',
        'status',
        'remarks',
    ];

    protected $casts = [
        'reservation_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
