<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use App\Models\Appointment;
//use App\Appointment;

use App\Http\Requests\StoreAppointment;

class AppointmentController extends Controller
{
    public function index()
    {
    	$user = Auth::guard('api')->user();
    	$appointments = $user->asPatientAppointments()
	    	->with([
	    		'specialty' => function ($query) {
	    			$query->select('id', 'name');
	    		}, 
	    		'doctor' => function ($query) {
	    			$query->select('id', 'name');
	    		}
	    	])
	    	->get([
				"id",
				"description",
				"specialty_id",
				"doctor_id",
				"scheduled_date",
				"scheduled_time",
				"type",
				"created_at",
				"status"
	    	]);

    	return $appointments;
        /*$user = Auth::guard('api')->user();

    	return $user->asPatientAppointments()->get([
				"id",
				"description",
				"specialty_id",
				"doctor_id",
				"scheduled_date",
				"scheduled_time",
				"type",
				"created_at",
				"status"

		]);*/
    }

    public function store(StoreAppointment $request)
    {
    	/*$patientId = Auth::guard('api')->id();
    	
    	$appointment = Appointment::createForPatient($request, $patientId);
    	
    	if ($appointment) 
    		$success = true;
    	else 
    		$success = false;

    	return compact('success');*/

		$success = Appointment::createForPatient($request, auth()->id());

		return compact('success');
    }
}
