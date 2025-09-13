<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\ScheduleServiceInterface;

use App\Models\Specialty;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentController extends Controller
{

    /*public function create(ScheduleServiceInterface $scheduleService)
    {
    	$specialties = Specialty::all();

        $specialtyId = old('specialty_id');
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
        }
        
    	return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }*/

    public function create(ScheduleServiceInterface $scheduleService)
    {
    	$specialties = Specialty::all();

        $specialtyId = old('specialty_id');
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
        }
        
    	return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
        //return view('appointments.create', compact('specialties','doctors'));
    }

    public function store(Request $request)
    {   
    	$data = $request->only([
            'description', 
            'specialty_id',
            'doctor_id',
            'scheduled_date',
            'scheduled_time',
            'type'
        ]);
        $data['patient_id'] = auth()->id();

        // right time format
        $carbonTime = Carbon::createFromFormat('g:i A',$data['scheduled_time']);
        $data['scheduled_time'] = $carbonTime->format('H:i:s');

        Appointment::create($data);

    
    	$notification = 'La cita se ha registrado correctamente!';

    	return back()->with(compact('notification'));

        /*$created = Appointment::createForPatient($request, auth()->id());

        if ($created)
    	   $notification = 'La cita se ha registrado correctamente!';
        else
           $notification = 'Ocurrió un problema al registrar la cita médica.';

    	return back()->with(compact('notification'));*/
    	
    }
}
