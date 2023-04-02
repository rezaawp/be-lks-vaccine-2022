<?php

namespace Database\Seeders;

use App\Models\Societie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Societie::create([
            'id_card_number' => '12341234',
            'born_date' => '2006-06-19',
            'gender' => 'male',
            'address' => 'Cikampek',
            'regional_id' => 1,
            'login_token' => md5('12341234')
        ]);
    }
}
