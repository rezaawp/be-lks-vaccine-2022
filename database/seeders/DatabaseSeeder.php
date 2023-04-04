<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Consultation;
use App\Models\Medical;
use App\Models\Regional;
use App\Models\Society;
use App\Models\Spot;
use App\Models\SpotVaccine;
use App\Models\User;
use App\Models\Vaccination;
use App\Models\Vaccine;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Reza',
            'username' => 'society',
            'id_card_number' => '12341234',
            'password' => bcrypt('12341234')
        ]);

        Regional::create([
            'province' => 'Jawa Barat',
            'district' => 'Karawang'
        ]);

        Society::create([
            'id_card_number' => '12341234',
            'name' => "Reza",
            'born_date' => '2006-07-19',
            'gender' => 'male',
            'address' => 'Jl. Jakarta 1032',
            'regional_id' => 1,
            'user_id' => 1
        ]);

        Spot::create([
            'regional_id' => 1,
            'name' => 'Intan Hospital',
            'address' => 'Jl. Jakarta 130',
            'serve' => 1,
            'capacity' => 12,
        ]);


        Medical::create([
            'spot_id' => 1,
            'role' => 'doctor',
            'name' => 'Dr. Reza'
        ]);

        Medical::create([
            'spot_id' => 1,
            'role' => 'officer',
            'name' => 'Ahsin Syifa'
        ]);

        $vaccineName = ['Sinovac', 'AstraZeneca', 'Moderna', 'Pfizer', 'Sinnophram'];
        foreach ($vaccineName as $vaccine) {
            Vaccine::create([
                'name' => $vaccine
            ]);
        }

        SpotVaccine::create([
            'spot_id' => 1,
            'vaccine_id' => 1
        ]);

        SpotVaccine::create([
            'spot_id' => 1,
            'vaccine_id' => 2
        ]);

        SpotVaccine::create([
            'spot_id' => 1,
            'vaccine_id' => 3
        ]);

        Vaccination::create([
            'dose' => 1,
            'date' => date('Y-m-d'),
            'society_id' => 1,
            'spot_id' => 1,
            'vaccine_id' => 1,
            'doctor_id' => 1,
            'officer_id' => 2,
            'queue' => 1
        ]);

        // Vaccination::create([
        //     'dose' => 2,
        //     'date' => date('Y-m-d'),
        //     'society_id' => 1,
        //     'spot_id' => 1,
        //     'vaccine_id' => 2,
        //     'doctor_id' => 1,
        //     'queue' => 2,
        //     'officer_id' => 2
        // ]);

        Consultation::create([
            'society_id' => 1,
            'status' => 'accepted',
            'disease_history' => 'disease_history',
            'current_symptoms' => 'current_symptoms'
        ]);
    }
}
