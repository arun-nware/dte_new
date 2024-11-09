<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeding_files.
     */
    public function run(): void
    {
        SiteSetting::create([
            'app_name' => "तकनीकी शिक्षा संचालनालय | मध्यप्रदेश शासन.",
            'copyright' => "Nwaresoft Pvt. Ltd.",
            'timezone' => "Asia/Kolkata",
            'currency' => "3",
            'favicon' => "images/settings/favicon.png",
            'logo' => "images/settings/logo.png",
            'financial_year' => date('Y'),
            'status' => true,
            'created_by' => 1,
        ]);
    }
}
