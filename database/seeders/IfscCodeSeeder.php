<?php

namespace Database\Seeders;

use App\Models\IfscCode;
use App\Models\Procedure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class IfscCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/seeding_files/IFSC.json");
        $ifsc = json_decode($json);

        foreach ($ifsc as $code) {
//
            IfscCode::create(
                [
                    "bank_name" => $code->BANK,
                    "ifsc_code" => $code->IFSC,
                    "branch_name" => $code->BRANCH,
                    "bank_address" => $code->ADDRESS,
                    "city1" => $code->CITY1,
                    "city2" => $code->CITY2,
                    "state" => $code->STATE,
                    "std_code" => $code->STDCODE,
                    "phone" => $code->PHONE,
                  ]
            );
        }
    }
}
