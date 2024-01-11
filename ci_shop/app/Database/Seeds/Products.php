<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\Product;

class Products extends Seeder
{
    public function run()
    {
        $product = new Product;
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
          $product->save(
                [
                    'user_id'     =>    1,
                    'name'        =>    $faker->name,
                    'description' =>    $faker->paragraph(),
                    'image'       =>    $faker->filePath(),
                    'created_at'  =>    Time::createFromTimestamp($faker->unixTime()),
                    'updated_at'  =>    Time::now()
                ]
            );
        }
    }
}
