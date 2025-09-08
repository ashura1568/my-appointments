<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use App\Interfaces\ScheduleServiceInterface;

use App\Models\WorkDay;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /*public function hours(Request $request, ScheduleServiceInterface $scheduleService)
    {
    	$rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'doctor_id' => 'required|exists:users,id'
    	];
    	$request->validate($rules);

    	$date = $request->input('date');
    	$doctorId = $request->input('doctor_id');

        return $scheduleService->getAvailableIntervals($date, $doctorId);    	
    }*/

        public function hours(Request $request)
    {
        $rules = [
    		'date' => 'required|date_format:"Y-m-d"',
    		'doctor_id' => 'required|exists:users,id'
    	];
        
    	$this->validate($request,$rules);

    	$date = $request->input('date');
    	$dateCarbon = new Carbon($date);

        //dateofWeek
        //Carbon: 0 (sunday) - 6 (Saturday)
        //Workday: 0(monday) - 6 (sunday)
        $i = $dateCarbon->dayOfWeek;
        $day = ($i==0 ? 6: $i-1);

        $doctorId = $request->input('doctor_id');

        $workDays = WorkDay::where('active',true)
            ->where('day',$day)
            ->where('user_id',$doctorId)->get();

        dd($workDays);

        //return $scheduleService->getAvailableIntervals($date, $doctorId);    	
    }

}
