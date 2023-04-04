<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Regional;
use App\Models\Society;
use App\Models\User;
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
    }
}
