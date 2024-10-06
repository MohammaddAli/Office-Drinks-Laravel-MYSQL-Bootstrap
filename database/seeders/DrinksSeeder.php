<?php

namespace Database\Seeders;

use App\Models\Drink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drinks = ['Tea', 'Coffe', 'Cola', 'Late', 'Lemon'];
        foreach($drinks as $drink){
            Drink::create(['name' => $drink, 'stock' => 500]);
        }
    }
}
