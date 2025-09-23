<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dni',
        'address',
        'phone',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // $user->specialties
    public function specialties()
    {
        return $this->belongsToMany(Specialty::class)->withTimestamps();
    }

    public function scopePatients($query)
    {
        return $query->where('role','patient');
    }

    public function scopeDoctors($query)
    {
        return $query->where('role','doctor');
    }

     // $user->asPatientAppointments  ->requestedAppointments
    // $user->asDoctorAppointments   ->attendedAppointments
    public function asDoctorAppointments()
    {
        return $this->hasMany(Appointment::class, 'doctor_id');
    }

    public function attendedAppointments()
    {
        return $this->asDoctorAppointments()->where('status', 'Atendida');
    }

    public function cancelledAppointments()
    {
        return $this->asDoctorAppointments()->where('status', 'Cancelada');
    }
    
    public function asPatientAppointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id');
    }
}
