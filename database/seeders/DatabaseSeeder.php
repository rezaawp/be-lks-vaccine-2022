<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Consultation;
use App\Models\Medical;
use App\Models\Regional;
use App\Models\Role;
use App\Models\Societie;
use App\Models\Spot;
use App\Models\SpotVaccine;
use App\Models\User;
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

        // $this->run(new RegionalSeeder());

        $data = [
            [
                'prov' => 'Jawa Barat',
                'kab' => 'Karawang'
            ],
            [
                'prov' => 'Jawa Barat',
                'kab' => 'Bandung'
            ],
            [
                'prov' => 'Jawa Barat',
                'kab' => 'Purwakarta'
            ],
            [
                'prov' => 'Jawa Barat',
                'kab' => 'Subang'
            ],
            [
                'prov' => 'Jawa Barat',
                'kab' => 'Gatau'
            ]
        ];

        foreach ($data as $item) {
            Regional::create([
                'province' => $item['prov'],
                'district' => $item['kab']
            ]);
        }

        Regional::create([
            'province' => 'Jawa Barat',
            'district' => 'Karawang'
        ]);


        $society = User::create([
            'name' => 'Society',
            'id_card_number' => '12341234',
            'password' => bcrypt('12341234')
        ]);

        Role::assignRole('society', $society['id']);

        $doctor = User::create([
            'name' => "Dr. Reza",
            'username' => 'doctor',
            'password' => bcrypt('12341234')
        ]);

        Role::assignRole('doctor', $doctor['id']);

        $officer = User::create([
            'name' => 'Officer Man',
            'username' => 'officer',
            'password' => bcrypt('12341234')
        ]);

        Role::assignRole('officer', $officer['id']);


        Societie::create([
            'id_card_number' => '12341234',
            'born_date' => '2006-06-19',
            'gender' => 'male',
            'address' => 'Cikampek',
            'regional_id' => 1,
            'user_id' => 1
        ]);
        // spots
        Spot::create([
            'regional_id' => 1,
            'name' => 'Intan Hospital',
            'address' => 'Jl Jakarta No 100',
            'serve' => 1,
            'capcity' => 10
        ]);

        $vaccines = ['Sinovac', 'AstraZeneca', 'Moderna', 'Pfizer', 'Sinnopharm'];

        foreach ($vaccines as $vaccine) {
            Vaccine::create([
                'name' => $vaccine
            ]);
        }

        $spot_vaccine = [
            [
                'spot_id' => 1,
                'vaccine_id' => 1
            ],
            [
                'spot_id' => 1,
                'vaccine_id' => 2
            ],
            [
                'spot_id' => 1,
                'vaccine_id' => 3
            ]
        ];
        foreach ($spot_vaccine as $spot_vaccine) {
            SpotVaccine::create([
                'spot_id' => $spot_vaccine['spot_id'],
                'vaccine_id' => $spot_vaccine['vaccine_id'],
            ]);
        }

        Medical::create([
            'spot_id' => 1,
            'user_id' => 2,
            'role' => 'doctor',
        ]);

        Consultation::create([
            'society_id' => 1,
            'disease_history' => 'disease_history',
            'current_symptoms' => 'current_symptoms',
            'status' => 'accepted'
        ]);
    }
}
