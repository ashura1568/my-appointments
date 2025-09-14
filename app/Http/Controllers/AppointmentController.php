<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Interfaces\ScheduleServiceInterface;

use App\Models\Specialty;
use App\Models\Appointment;
use Carbon\Carbon;
use Validator;

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

    public function store(Request $request,ScheduleServiceInterface $scheduleService)
    {   
        $rules = [
            'description' => 'required',
            'specialty_id' => 'exists:specialties,id',
            'doctor_id' => 'exists:users,id',
            'scheduled_time' => 'required'
        ];
        $messages = [
            'scheduled_time.required' => 'Por favor seleccione una hora valida para su cita'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request, $scheduleService) {
            $date = $request->input('scheduled_date');
            $doctorId = $request->input('doctor_id');
            $scheduled_time = $request->input('scheduled_time');

            if (!$date || !$doctorId || !$scheduled_time) {
                return;
            }

            $start = new Carbon($scheduled_time);

            if (!$scheduleService->isAvailableInterval($date, $doctorId, $start)) {
                $validator->errors()
                    ->add('available_time', 'La hora seleccionada ya se encuentra reservada por otro paciente.');
            }
        });

        if($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }



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
