<?php

//use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Specialty;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    	/*foreach ($specialties as $specialtyName) {
    		$specialty = Specialty::create([
	        	'name' => $specialtyName
	        ]);

            $specialty->users()->saveMany(
                factory(User::class, 3)->states('doctor')->make()
            );
    	}*/

        // Médico Test
        //User::find(3)->specialties()->save($specialty); 
    }
}
