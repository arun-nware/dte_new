<?php

namespace App\Models;

use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class AllotmentList extends Model
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
        'common_rank',
        'merit',
        'roll_number',
        'name',
        'fathers_name',
        'dob',
        'eligible_domicile',
        'eligible_category',
        'eligible_jk_residents',
        'eligible_jk_migrants',
        'fee_waiver',
        'exam',
        'allotted_preference',
        'allotted_inst_code',
        'allotted_inst_name',
        'allotted_inst_type',
        'allotted_inst_fw',
        'allotted_branch',
        'allotted_domicile',
        'allotted_category',
        'user_name',
        'dte_college_code',
        'round',
        'year',
        'file_upload_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return (new \Spatie\Activitylog\LogOptions)->logFillable();
    }
}
