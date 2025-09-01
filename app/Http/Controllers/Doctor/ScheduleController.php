<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
     public function edit()
    {   
        $days = [
            'Lunes','Martes','Miercoles',
            'Jueves','Viernes','Sabado','Domingo'
        ];
        return view('schedule', compact('days'));
    }
}
