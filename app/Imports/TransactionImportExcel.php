<?php

namespace App\Imports;

use App\Models\College;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TransactionImportExcel implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithBatchInserts
{
    use Importable, Batchable;

    public function model(array $row)
    {
        return new College([
            'course' => $row['course'],
            'inst_name' => $row['inst_name'],
            'AICTE_code' => $row['aicte_code'],
            'inst_count' => $row['inst_count'],
            'user_name' => $row['user_name'],
            'branch_code' => $row['branch_code'],
            'branch_name' => $row['branch_name'],
            'institute_type' => $row['institutetype'],
            'total_st_seats' => $row['totalstseats'],
            'total_sc_seats' => $row['totalscseats'],
            'total_obc_seats' => $row['totalobcseats'],
            'total_ur_seats' => $row['totalurseats'],
            'nri_seats' => $row['nri_seats'],
            'ips_seats' => $row['ips_seats'],
            'fw_seats' => $row['fw_seats'],
            'fw_admission' => $row['fw_admission'],
            'ews_seats' => $row['ews_seats'],
            'ews_admission' => $row['ews_admission'],
            'ai_jk_resident_seats' => $row['ai_jk_resident_seats'],
            'ai_jk_migrants_seats' => $row['ai_jk_migrants_seats'],
            'intake' => $row['intake'],
            'intake_with_ews' => $row['intake_with_ews'],
            'total_admitted_male' => $row['totaladmittedmale'],
            'total_admitted_female' => $row['totaladmittedfemale'],
            'total_admitted' => $row['totaladmitted'],
            'st_female_admitted' => $row['st_female_admitted'],
            'st_male_admitted' => $row['st_male_admitted'],
            'total_st_admitted' => $row['total_st_admitted'],
            'sc_female_admitted' => $row['sc_female_admitted'],
            'sc_male_admitted' => $row['sc_male_admitted'],
            'total_sc_admitted' => $row['total_sc_admitted'],
            'obc_female_admitted' => $row['obc_female_admitted'],
            'obc_male_admitted' => $row['obc_male_admitted'],
            'total_obc_admitted' => $row['total_obc_admitted'],
            'ur_female_admitted' => $row['ur_female_admitted'],
            'ur_male_admitted' => $row['ur_male_admitted'],
            'total_ur_admitted' => $row['total_ur_admitted'],
            'year' => now()->format('Y'),
        ]);
    }

    public function startRow(): int
    {
        return 3;
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 250;
    }

    public function mapping(): array
    {
        return [
            'course' => 'course',
            'inst_name' => 'inst_name',
            'AICTE_code' => 'aicte_code',
            'inst_count' => 'inst_count',
            'user_name' => 'user_name',
            'branch_code' => 'branch_code',
            'branch_name' => 'branch_name',
            'institute_type' => 'institutetype',
            'total_st_seats' => 'totalstseats',
            'total_sc_seats' => 'totalscseats',
            'total_obc_seats' => 'totalobcseats',
            'total_ur_seats' => 'totalurseats',
            'nri_seats' => 'nri_seats',
            'ips_seats' => 'ips_seats',
            'fw_seats' => 'fw_seats',
            'fw_admission' => 'fw_admission',
            'ews_seats' => 'ews_seats',
            'ews_admission' => 'ews_admission',
            'ai_jk_resident_seats' => 'ai_jk_resident_seats',
            'ai_jk_migrants_seats' => 'ai_jk_migrants_seats',
            'intake' => 'intake',
            'intake_with_ews' => 'intake_with_ews',
            'total_admitted_male' => 'totaladmittedmale',
            'total_admitted_female' => 'totaladmittedfemale',
            'total_admitted' => 'totaladmitted',
            'st_female_admitted' => 'st_female_admitted',
            'st_male_admitted' => 'st_male_admitted',
            'total_st_admitted' => 'total_st_admitted',
            'sc_female_admitted' => 'sc_female_admitted',
            'sc_male_admitted' => 'sc_male_admitted',
            'total_sc_admitted' => 'total_sc_admitted',
            'obc_female_admitted' => 'obc_female_admitted',
            'obc_male_admitted' => 'obc_male_admitted',
            'total_obc_admitted' => 'total_obc_admitted',
            'ur_female_admitted' => 'ur_female_admitted',
            'ur_male_admitted' => 'ur_male_admitted',
            'total_ur_admitted' => 'total_ur_admitted'
        ];
    }

}
