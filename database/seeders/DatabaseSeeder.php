<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
//use Database\seeders\UsersTableSeeder;
use App\Models\User;
use App\Models\Specialty;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
            //$this->call(UsersTableSeeder::class);
            //$this->call(SpecialtiesTableSeeder::class);
            /*UsersTableSeeder::class,
            SpecialtiesTableSeeder::class,
            WorkDaysTableSeeder::class,
            AppointmentsTableSeeder::class*/
    

        User::create([
    		'name' => 'Andres Molina',
	        'email' => 'hola@mail.com',
	        'password' => bcrypt('123'),
	        'role' => 'admin'
    	]);

        // 2
        User::create([
            'name' => 'Paciente Test',
            'email' => 'hola3@mail.com',
            'password' => bcrypt('123'),
            'role' => 'patient'
        ]);

        // 3
        User::create([
            'name' => 'Médico Test',
            'email' => 'hola2@mail.com',
            'password' => bcrypt('123'),
            'role' => 'doctor'
        ]);

        User::factory(50)->create();
        
        $specialties = [
    		'Oftalmología',
    		'Pediatría',
    		'Neurología'
    	];
        foreach ($specialties as $specialty) {
    		Specialty::create([
	        	'name' => $specialty
	        ]);
    	}
        
    }
}