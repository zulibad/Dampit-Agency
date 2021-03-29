<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'Koran Kompas',
            'description' => 'Langganan Bulanan Koran',
            'price' => 110000,
            'stock' => 100
        ]);

        Product::create([
            'title' => 'Koran Wartakota',
            'description' => 'Langganan Bulanan Koran',
            'price' => 55000,
            'stock' => 100
        ]);
    }
}
