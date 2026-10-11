<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'building',
        'room_number',
        'capacity',
        'description',
        'status',
    ];

    public function equipment()
    {
        return $this->hasMany(Equipment::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
