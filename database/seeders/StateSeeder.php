<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeding_files.
     */
    public function run(): void
    {
        $state = State::create(['name' => 'MADHYA PRADESH', 'code' => '70']);
        $collected = collect([
            ['name' => 'SINGRAULI', 'code'=> 295, 'state_id' => $state->id],
            ['name' => 'ALIRAJPUR', 'code'=> 296, 'state_id' => $state->id],
            ['name' => 'AGAR-MALWA', 'code'=> 377, 'state_id' => $state->id],
            ['name' => 'SEHORE', 'code'=> 700, 'state_id' => $state->id],
            ['name' => 'SHEOPUR', 'code'=> 701, 'state_id' => $state->id],
            ['name' => 'RAISEN', 'code'=> 702, 'state_id' => $state->id],
            ['name' => 'UMARIA', 'code'=> 703, 'state_id' => $state->id],
            ['name' => 'SAGAR', 'code'=> 705, 'state_id' => $state->id],
            ['name' => 'HARDA', 'code'=> 706, 'state_id' => $state->id],
            ['name' => 'DAMOH', 'code'=> 708, 'state_id' => $state->id],
            ['name' => 'KATNI', 'code'=> 709, 'state_id' => $state->id],
            ['name' => 'JABALPUR', 'code'=> 710, 'state_id' => $state->id],
            ['name' => 'DINDORI', 'code'=> 711, 'state_id' => $state->id],
            ['name' => 'MANDLA', 'code'=> 712, 'state_id' => $state->id],
            ['name' => 'SEONI', 'code'=> 713, 'state_id' => $state->id],
            ['name' => 'NARSIMHAPUR', 'code'=> 714, 'state_id' => $state->id],
            ['name' => 'CHHINDWARA', 'code'=> 715, 'state_id' => $state->id],
            ['name' => 'HOSHANGABAD', 'code'=> 716, 'state_id' => $state->id],
            ['name' => 'BETUL', 'code'=> 717, 'state_id' => $state->id],
            ['name' => 'EAST NIMAR', 'code'=> 718, 'state_id' => $state->id],
            ['name' => 'DEWAS', 'code'=> 719, 'state_id' => $state->id],
            ['name' => 'INDORE', 'code'=> 720, 'state_id' => $state->id],
            ['name' => 'ANUPPUR', 'code'=> 721, 'state_id' => $state->id],
            ['name' => 'WEST NIMAR', 'code'=> 722, 'state_id' => $state->id],
            ['name' => 'BARWANI', 'code'=> 723, 'state_id' => $state->id],
            ['name' => 'DHAR', 'code'=> 724, 'state_id' => $state->id],
            ['name' => 'BURHANPUR', 'code'=> 725, 'state_id' => $state->id],
            ['name' => 'JHABUA', 'code'=> 726, 'state_id' => $state->id],
            ['name' => 'RATLAM', 'code'=> 727, 'state_id' => $state->id],
            ['name' => 'MANDSAUR', 'code'=> 728, 'state_id' => $state->id],
            ['name' => 'NEEMUCH', 'code'=> 729, 'state_id' => $state->id],
            ['name' => 'UJJAIN', 'code'=> 730, 'state_id' => $state->id],
            ['name' => 'ASHOKNAGAR', 'code'=> 731, 'state_id' => $state->id],
            ['name' => 'SHAJAPUR', 'code'=> 732, 'state_id' => $state->id],
            ['name' => 'RAJGARH', 'code'=> 734, 'state_id' => $state->id],
            ['name' => 'VIDISHA', 'code'=> 735, 'state_id' => $state->id],
            ['name' => 'GUNA', 'code'=> 736, 'state_id' => $state->id],
            ['name' => 'SHIVPURI', 'code'=> 737, 'state_id' => $state->id],
            ['name' => 'MORENA', 'code'=> 738, 'state_id' => $state->id],
            ['name' => 'BHIND', 'code'=> 739, 'state_id' => $state->id],
            ['name' => 'GWALIOR', 'code'=> 740, 'state_id' => $state->id],
            ['name' => 'DATIA', 'code'=> 742, 'state_id' => $state->id],
            ['name' => 'TIKAMGARH', 'code'=> 743, 'state_id' => $state->id],
            ['name' => 'CHHATARPUR', 'code'=> 744, 'state_id' => $state->id],
            ['name' => 'PANNA', 'code'=> 745, 'state_id' => $state->id],
            ['name' => 'SATNA', 'code'=> 746, 'state_id' => $state->id],
            ['name' => 'REWA', 'code'=> 747, 'state_id' => $state->id],
            ['name' => 'SIDHI', 'code'=> 748, 'state_id' => $state->id],
            ['name' => 'SHAHDOL', 'code'=> 749, 'state_id' => $state->id],
            ['name' => 'BALAGHAT', 'code'=> 752, 'state_id' => $state->id],
            ['name' => 'BHOPAL', 'code'=> 764, 'state_id' => $state->id],
        ]);

        $collected->each(function ($district){
            $district = District::create($district);
        });
    }
}
