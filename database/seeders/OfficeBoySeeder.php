<?php

namespace Database\Seeders;

use App\Models\OfficeBoy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeBoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OfficeBoy::create(['name'=>'Samir']);
    }
}
