<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeding_files.
     */
    public function run(): void
    {
        $regions = collect(
            [
                [
                    'name' => 'Bhopal',
                    'code' => 755,
                    'status' => 1,
                ],
                [
                    'name' => 'Ujjain',
                    'code' => 734,
                    'status' => 1,
                ],
                [
                    'name' => 'Gwalior',
                    'code' => 751,
                    'status' => 1,
                ],
                [
                    'name' => 'Narmadapuram',
                    'code' => 7574,
                    'status' => 1,
                ],
                [
                    'name' => 'Sagar',
                    'code' => 7582,
                    'status' => 1,
                ],
                [
                    'name' => 'Rewa',
                    'code' => 7662,
                    'status' => 1,
                ],
                [
                    'name' => 'Indore',
                    'code' => 731,
                    'status' => 1,
                ],
                [
                    'name' => 'Jabalpur',
                    'code' => 761,
                    'status' => 1,
                ],
            ]
        );

        $regions->each(function ($region) {
            \App\Models\Region::create($region);
        });
    }
}
