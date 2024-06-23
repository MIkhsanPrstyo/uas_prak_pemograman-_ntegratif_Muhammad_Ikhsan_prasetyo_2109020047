<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Room;
use App\Models\RoomAssignment;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function admit(Request $request)
    {
        $patient = Patient::create([
            'name' => $request->name,
            'admitted_at' => now()
        ]);

        $room = Room::find($request->room_id);
        if ($room->is_available) {
            RoomAssignment::create([
                'room_id' => $room->id,
                'patient_id' => $patient->id,
                'assigned_at' => now()
            ]);
            $room->update(['is_available' => false]);
            return response()->json(['message' => 'Patient admitted successfully']);
        }

        return response()->json(['message' => 'Room not available'], 400);
    }

    public function discharge(Request $request)
    {
        $assignment = RoomAssignment::where('patient_id', $request->patient_id)->whereNull('released_at')->first();
        if ($assignment) {
            $assignment->update(['released_at' => now()]);
            $room = Room::find($assignment->room_id);
            $room->update(['is_available' => true]);

            $patient = Patient::find($request->patient_id);
            $patient->update(['discharged_at' => now()]);

            return response()->json(['message' => 'Patient discharged successfully']);
        }

        return response()->json(['message' => 'Patient not found or already discharged'], 400);
    }
}

