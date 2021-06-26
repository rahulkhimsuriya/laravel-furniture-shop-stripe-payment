<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com'
        ]);

        Product::factory(6)
        ->state(new Sequence(
            [
                'name' => 'Sofa (Black)',
                'image' => 'black-sofa-unsplash.jpg',
                'price' => '2500000'
            ],
            [
                'name' => 'Armless Chair (Purple)',
                'image' => 'purple-armless-chair-unsplash.jpg',
                'price' => '350000'
            ],
            [
                'name' => 'Wooden Armchair',
                'image' => 'wooden-armchair-unsplash.jpg',
                'price' => '500000'
            ],
            [
                'name' => 'Wooden Table',
                'image' => 'wooden-table-unsplash.jpg',
                'price' => '800000'
            ],
            [
                'name' => 'Wooden Table with Chairs',
                'image' => 'wooden-table-with-chairs-unsplash.jpg',
                'price' => '1500000'
            ],
            [
                'name' => 'Sofa (Yellow)',
                'image' => 'yellow-sofa-unsplash.jpg',
                'price' => '3500000'
            ],
        ))
        ->create();
    }
}
