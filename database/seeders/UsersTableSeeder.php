<?php
//namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
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
        //factory(User::class, 50)->states('patient')->create();
    }
}