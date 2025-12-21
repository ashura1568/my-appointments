<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

class FirebaseController extends Controller
{
    public function sendAll(Request $request)
    {
		dd($request->all());
    	/*$recipients = User::whereNotNull('device_token')
    		->pluck('device_token')->toArray();
    	// dd($recipients);

    	fcm()
		    ->to($recipients) // array
		    ->notification([
		        'title' => $request->input('title'),
		        'body' => $request->input('body')
		    ])
		    ->send();

		$notification = 'Notificación enviada a todos los usuarios (Android).';
		return back()->with(compact('notification'));*/
    }
}
