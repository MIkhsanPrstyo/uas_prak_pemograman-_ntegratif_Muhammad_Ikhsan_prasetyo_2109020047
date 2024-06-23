<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['level_id', 'room_number', 'is_available'];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function roomAssignments()
    {
        return $this->hasMany(RoomAssignment::class);
    }
}

