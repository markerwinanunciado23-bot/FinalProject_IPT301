<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'reported_date',
        'maintenance_type',
        'description',
        'assigned_to',
        'cost',
        'status',
        'completed_date',
    ];

    protected $casts = [
        'reported_date' => 'date',
        'completed_date' => 'date',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}
