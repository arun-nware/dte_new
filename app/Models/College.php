<?php

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class College extends Model
{
    use HasFactory, SoftDeletes;
    use LogsActivity;

    public ?string $logName = null;
    public bool $submitEmptyLogs = true;
    public bool $logFillable = true;
    public bool $logOnlyDirty = true;
    public bool $logUnguarded = true;
    public array $logAttributes = [];
    public array $logExceptAttributes = [];
    public array $dontLogIfAttributesChangedOnly = [];
    public array $attributeRawValues = [];
    public ?Closure $descriptionForEvent = null;

    protected $fillable = [
        'course',
        'inst_name',
        'AICTE_code',
        'inst_count',
        'user_name',
        'branch_code',
        'branch_name',
        'institute_type',
        'total_st_seats',
        'total_sc_seats',
        'total_obc_seats',
        'total_ur_seats',
        'nri_seats',
        'ips_seats',
        'fw_seats',
        'fw_admission',
        'ews_seats',
        'ews_admission',
        'ai_jk_resident_seats',
        'ai_jk_migrants_seats',
        'intake',
        'intake_with_ews',
        'total_admitted_male',
        'total_admitted_female',
        'total_admitted',
        'st_female_admitted',
        'st_male_admitted',
        'total_st_admitted',
        'sc_female_admitted',
        'sc_male_admitted',
        'total_sc_admitted',
        'obc_female_admitted',
        'obc_male_admitted',
        'total_obc_admitted',
        'ur_female_admitted',
        'ur_male_admitted',
        'total_ur_admitted',
        'year',
        'file_upload_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return (new \Spatie\Activitylog\LogOptions)->logFillable();
    }

}
