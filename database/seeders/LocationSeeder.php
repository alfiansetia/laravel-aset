<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Location::factory(10)->create();
        $locations = [
            'OFFICE BEKASI',
            'WH BEKASI',
            'MK BEKASI',
            'OFFICE PUSAT',
            'WH PUSAT',
            'MK PUSAT',
        ];
        foreach ($locations as $item) {
            Location::create(['name' => $item]);
        }
    }
}
