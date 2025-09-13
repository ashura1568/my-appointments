<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\ScheduleServiceInterface;

use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function hours(Request $request, ScheduleServiceInterface $scheduleService)
    {
    	$rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'doctor_id' => 'required|exists:users,id'
    	];
    	$request->validate($rules);

    	$date = $request->input('date');
    	$doctorId = $request->input('doctor_id');

        return $scheduleService->getAvailableIntervals($date, $doctorId);    	
    }

        /*public function hours(Request $request)
    {
        $rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'doctor_id' => 'required|exists:users,id'
    	];
        
    	$this->validate($request,$rules);

    	$date = $request->input('date');
    	$dateCarbon = new Carbon($date);

        return $data;

        //dd($workDays);

        //return $scheduleService->getAvailableIntervals($date, $doctorId);    	
    }*/

    

}
