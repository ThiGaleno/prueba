<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Television',
            'price' => 720000,
        ]);
        Product::create([
            'name' => 'DVD',
            'price' => 109000 ,
        ]);
        Product::create([
            'name' => 'Equipo de sonido',
            'price' => 836000,
        ]);
        Product::create([
            'name' => 'Tablet',
            'price' => 345000,
        ]);
    }
}
