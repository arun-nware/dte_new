<?php

namespace App\Imports;

use App\Models\College;
use App\Models\Student;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImportExcel implements ToModel, WithHeadingRow, ShouldQueue, WithChunkReading, WithBatchInserts
{
    use Importable, Batchable;

    private $fileUpload;
    /**
     * Create a new job instance.
     */
    public function __construct($filePath, $fileUpload)
    {
        $this->fileUpload = $fileUpload;
    }

    public function model(array $row)
    {
        return new Student([
            'course' => $row['course'],
            'roll_number' => $row['roll_number'],
            'candidate_name' => $row['candidate_name'],
            'date_of_birth' => $row['date_of_birth'],
            'father_name' => $row['father_name'],
            'admitted_institute' => $row['admitted_institute'],
            'institute_user_name' => $row['institute_user_name'],
            'admitted_branch' => $row['admitted_branch'],
            'gender' => $row['gender'],
            'university' => $row['university'],
            'tuition_fee_waiver_status' => $row['tuition_fee_waiver_status'],
            'admission_date' => $row['admission_date'],
            'round' => $row['round'],
            'cancelled_after_clc_verification' => $row['cancelled_after_clc_verification'],
            'year' => now()->format('Y'),
            'file_upload_id' => $this->fileUpload->id
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
