<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'admitted_at', 'discharged_at'];

    public function roomAssignments()
    {
        return $this->hasMany(RoomAssignment::class);
    }
}
