<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Controllers\Controller;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$doctors = User::where('role','doctor')->get();
        //scope
        $doctors = User::doctors()->get();

        return view('doctors.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   

        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules=[
        'name' => 'required|min:3',
        'email' => 'required|email',
        'dni' => 'nullable|digits:8',
        'address' => 'nullable|min:5',
        'phone' => 'nullable|min:6'
        ];

        $this->validate($request, $rules);
        
        //mass assigment
        User::create(
            $request->only('name','email','dni','address','phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'El medico se ha registrado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = User::doctors()->findOrFail($id);
        return view('doctors.edit',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules=[
        'name' => 'required|min:3',
        'email' => 'required|email',
        'dni' => 'nullable|digits:8',
        'address' => 'nullable|min:5',
        'phone' => 'nullable|min:6'
        ];

        $this->validate($request, $rules);
        
        $user = User::doctors()->findOrFail($id);

        $data = $request->only('name','email','dni','address','phone');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password); 
        
        $user->fill($data);
        $user->save();//UPDATE

        $notification = 'El medico se ha modificado correctamente.';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $doctor)
    {
        $doctorName = $doctor->name;
        $doctor->delete();

        $notification = "El medico $doctorName se ha eliminado correctamente.";
        return redirect('/doctors')->with(compact('notification'));
    }
}
