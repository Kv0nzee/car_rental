<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Category;
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

        $categories = [
            ['name' => 'Minivan'],
            ['name' => 'Midsize Car'],
            ['name' => 'Small Sport Utility Vehicle'],
            ['name' => 'Compact Car'],
            ['name' => 'Subcompact Car'],
            ['name' => 'Minicompact Car'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        $brands = [
            ['name' => 'Honda'],
            ['name' => 'Kia'],
            ['name' => 'Acura'],
            ['name' => 'Hyundai'],
            ['name' => 'Mitsubishi'],
            ['name' => 'Genesis'],
            ['name' => 'Mini'],
            ['name' => 'BMW'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }

        $jsonData = '[
            {
                "city_mpg": 19,
                "category_id": 1,
                "combination_mpg": 22,
                "cylinders": 6,
                "displacement": 3.5,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 28,
                "brand_id": 1,
                "name": "odyssey",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 21,
                "category_id": 2,
                "combination_mpg": 24,
                "cylinders": 4,
                "displacement": 2.5,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 29,
                "brand_id": 2,
                "name": "stinger awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 22,
                "category_id": 2,
                "combination_mpg": 25,
                "cylinders": 4,
                "displacement": 2.5,
                "drive": "rwd",
                "fuel_type": "gas",
                "highway_mpg": 32,
                "brand_id": 2,
                "name": "stinger rwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 17,
                "category_id": 2,
                "combination_mpg": 20,
                "cylinders": 6,
                "displacement": 3.3,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 24,
                "brand_id": 2,
                "name": "stinger awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 18,
                "category_id": 2,
                "combination_mpg": 20,
                "cylinders": 6,
                "displacement": 3.3,
                "drive": "rwd",
                "fuel_type": "gas",
                "highway_mpg": 25,
                "brand_id": 2,
                "name": "stinger rwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 19,
                "category_id": 1,
                "combination_mpg": 22,
                "cylinders": 6,
                "displacement": 3.5,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 26,
                "brand_id": 2,
                "name": "carnival",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 19,
                "category_id": 3,
                "combination_mpg": 22,
                "cylinders": 6,
                "displacement": 3.5,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 26,
                "brand_id": 3,
                "name": "mdx fwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 26,
                "category_id": 3,
                "combination_mpg": 29,
                "cylinders": 4,
                "displacement": 2.5,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 33,
                "brand_id": 4,
                "name": "tucson fwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 25,
                "category_id": 3,
                "combination_mpg": 26,
                "cylinders": 4,
                "displacement": 1.5,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 28,
                "brand_id": 5,
                "name": "eclipse cross 2wd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 26,
                "category_id": 3,
                "combination_mpg": 27,
                "cylinders": 4,
                "displacement": 1.5,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 29,
                "brand_id": 5,
                "name": "eclipse cross es 2wd",
                "transmission": "a",
                "image": null,
                "year": 2022
            }
        ]';

        $jsonData2 = '[
            {
                "city_mpg": 19,
                "category_id": 3,
                "combination_mpg": 21,
                "cylinders": 6,
                "displacement": 3.5,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 25,
                "brand_id": 3,
                "name": "mdx awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 25,
                "category_id": 3,
                "combination_mpg": 25,
                "cylinders": 4,
                "displacement": 1.5,
                "drive": "4wd",
                "fuel_type": "gas",
                "highway_mpg": 26,
                "brand_id": 5,
                "name": "eclipse cross 4wd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 25,
                "category_id": 3,
                "combination_mpg": 26,
                "cylinders": 4,
                "displacement": 1.5,
                "drive": "4wd",
                "fuel_type": "gas",
                "highway_mpg": 28,
                "brand_id": 5,
                "name": "eclipse cross es 4wd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 18,
                "category_id": 4,
                "combination_mpg": 21,
                "cylinders": 6,
                "displacement": 3.3,
                "drive": "rwd",
                "fuel_type": "gas",
                "highway_mpg": 27,
                "brand_id": 6, 
                "name": "g70 rwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 20,
                "category_id": 3,
                "combination_mpg": 23,
                "cylinders": 4,
                "displacement": 2,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 28,
                "brand_id": 2,
                "name": "sportage fwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 23,
                "category_id": 3,
                "combination_mpg": 26,
                "cylinders": 4,
                "displacement": 2.4,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 30,
                "brand_id": 2,
                "name": "sportage fwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 24,
                "category_id": 3,
                "combination_mpg": 27,
                "cylinders": 4,
                "displacement": 2.5,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 31,
                "brand_id": 5,
                "name": "outlander 2wd",
                "transmission": "a",
                "image": null,
                "year": 2022
            }
        ]';

        $jsonData3 = '[
            {
                "city_mpg": 19,
                "category_id": 3,
                "combination_mpg": 21,
                "cylinders": 6,
                "displacement": 3.5,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 25,
                "brand_id": 6,
               "name": "gv70 awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 24,
                "category_id": 3,
                "combination_mpg": 26,
                "cylinders": 4,
                "displacement": 2.5,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 29,
                "brand_id": 4,
                "name": "tucson awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 19,
                "category_id": 3,
                "combination_mpg": 21,
                "cylinders": 4,
                "displacement": 2,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 24,
                "brand_id": 2,
                "name": "sportage awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 22,
                "category_id": 3,
                "combination_mpg": 23,
                "cylinders": 4,
                "displacement": 2.4,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 26,
                "brand_id": 2,
                "name": "sportage awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 24,
                "category_id": 3,
                "combination_mpg": 26,
                "cylinders": 4,
                "displacement": 2.5,
                "drive": "4wd",
                "fuel_type": "gas",
                "highway_mpg": 30,
                "brand_id": 5,
                "name": "outlander 4wd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 29,
                "category_id": 3,
                "combination_mpg": 32,
                "cylinders": 4,
                "displacement": 1.6,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 35,
                "brand_id": 4,
                "name": "kona fwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 30,
                "category_id": 3,
                "combination_mpg": 32,
                "cylinders": 4,
                "displacement": 2,
                "drive": "fwd",
                "fuel_type": "gas",
                "highway_mpg": 35,
                "brand_id": 4,
                "name": "kona fwd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 27,
                "category_id": 3,
                "combination_mpg": 29,
                "cylinders": 4,
                "displacement": 1.6,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 32,
                "brand_id": 4,
                "name": "kona awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            },
            {
                "city_mpg": 28,
                "category_id": 3,
                "combination_mpg": 30,
                "cylinders": 4,
                "displacement": 2,
                "drive": "awd",
                "fuel_type": "gas",
                "highway_mpg": 33,
                "brand_id": 4,
                "name": "kona awd",
                "transmission": "a",
                "image": null,
                "year": 2022
            }
        ]';

        $carData = json_decode($jsonData, true);
        $anotherData = json_decode($jsonData2, true);
        $anotherDat2 = json_decode($jsonData3, true);
        foreach ($carData as $car) {
            try {
                // Make sure your 'Cars' model is correctly defined
                Car::create($car);
            } catch (\Exception $e) {
                echo "Error creating record: " . $e->getMessage();
            }
        }
        foreach ($anotherData as $car) {
            try {
                // Make sure your 'Cars' model is correctly defined
                Car::create($car);
            } catch (\Exception $e) {
                echo "Error creating record: " . $e->getMessage();
            }
        }
        foreach ($anotherDat2 as $car) {
            try {
                // Make sure your 'Cars' model is correctly defined
                Car::create($car);
            } catch (\Exception $e) {
                echo "Error creating record: " . $e->getMessage();
            }
        }

    }
}
