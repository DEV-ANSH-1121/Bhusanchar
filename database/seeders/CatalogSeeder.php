<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Crop;
use App\Models\Packaging;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Seed product catalog lookup values.
     */
    public function run(): void
    {
        foreach ([
            'Fertilizers',
            'Bio-Fertilizers',
            'Organic Fertilizers',
            'Micronutrients',
            'Soil Conditioners',
            'Bio-Stimulants',
            'Plant Nutrition Products',
            'Other Agricultural Inputs',
        ] as $name) {
            Category::query()->firstOrCreate(['name' => $name]);
        }

        foreach ([
            'Wheat',
            'Rice',
            'Maize',
            'Vegetables',
            'Fruits',
            'Paddy',
            'Pulses',
            'Cotton',
            'Flowers',
            'All crop types',
        ] as $name) {
            Crop::query()->firstOrCreate(['name' => $name]);
        }

        foreach ([
            '500 g',
            '1 kg',
            '5 kg',
            '10 kg',
            '15 kg',
            '20 kg',
            '25 kg',
            '50 kg',
            '1 litre',
            'Set',
        ] as $name) {
            Packaging::query()->firstOrCreate(['name' => $name]);
        }
    }
}
