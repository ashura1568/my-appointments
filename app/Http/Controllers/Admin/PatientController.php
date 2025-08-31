<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$patients = User::where('role','patient')->get();
        //scopes
        $patients = User::patients()->paginate(5);
        return view('patients.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('patients.create');
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
                'role' => 'patient',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $notification = 'El paciente se ha registrado correctamente.';
        return redirect('/patients')->with(compact('notification'));
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
    public function edit(User $patient)
    {
        return view('patients.edit',compact('patient'));
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
        
        $user = User::patients()->findOrFail($id);

        $data = $request->only('name','email','dni','address','phone');
        $password = $request->input('password');
        if($password)
            $data['password'] = bcrypt($password); 
        
        $user->fill($data);
        $user->save();//UPDATE

        $notification = 'El paciente se ha modificado correctamente.';
        return redirect('/patients')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $patient)
    {
        $patientName = $patient->name;
        $patient->delete();

        $notification = "El paciente $patientName se ha eliminado correctamente.";
        return redirect('/patients')->with(compact('notification'));
    }
}
