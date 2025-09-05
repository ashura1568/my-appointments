<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;

class AppointmentController extends Controller
{
    public function create()
    {
    	$specialties = Specialty::all();

        /*$specialtyId = old('specialty_id');
        if ($specialtyId) {
            $specialty = Specialty::find($specialtyId);
            $doctors = $specialty->users;
        } else {
            $doctors = collect();
        }
        
        $date = old('scheduled_date');
        $doctorId = old('doctor_id');
        if ($date && $doctorId) {
            $intervals = $scheduleService->getAvailableIntervals($date, $doctorId);
        } else {
            $intervals = null;
        }*/
        
    	//return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
        return view('appointments.create', compact('specialties'));
    }
}
