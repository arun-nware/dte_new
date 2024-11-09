<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeding_files.
     */
    public function run(): void
    {
        $weekdays = [
            '1' => 'Monday',
            '2' => 'Tuesday',
            '3' => 'Wednesday',
            '4' => 'Thursday',
            '5' => 'Friday',

        ];

        $weekends = [
            '6' => 'Saturday',
            '7' => 'Sunday'
        ];
        Setting::create([
            'site_name' => 'Nwaresoft Pvt Ltd',
            'site_address' => 'Noida',
            'site_contact' => '9156789871',
            'site_email' => 'info@nwaresoft.com',
            'weekdays' => serialize($weekdays),
            'weekends' => serialize($weekends),
        ]);
    }
}
