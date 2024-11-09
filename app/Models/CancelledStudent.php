<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CancelledStudent extends Model
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
        'roll_no',
        'roll_number',
        'candidate_name',
        'date_of_birth',
        'father_name',
        'admitted_institute',
        'institute_user_name',
        'admitted_branch',
        'gender',
        'university',
        'tuition_fee_waiver_status',
        'cancellation_date',
        'round',
        'year',
        'file_upload_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return (new \Spatie\Activitylog\LogOptions)->logFillable();
    }
}
