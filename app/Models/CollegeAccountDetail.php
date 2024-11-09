<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CollegeAccountDetail extends Model
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
        'institute_name',
        'institute_type',
        'address',
        'user_name',
        'aicte_code',
        'fax',
        'institute_contact_no',
        'institute_email',
        'chairman_name',
        'chairman_mobile_no',
        'chairman_email_id',
        'secretary_name',
        'secretary_mobile_no',
        'secretary_email_id',
        'director_name',
        'director_mobile_no',
        'director_email_id',
        'nodal_officer_name',
        'nodal_officer_mobile_no',
        'nodal_officer_email_id',
        'asstt_nodal_officer_name',
        'asstt_nodal_officer_mobile_no',
        'asstt_nodal_officer_email_id',
        'account_holder_name',
        'bank',
        'branch',
        'ifsc',
        'account_number',
        'last_modified_date',
        'course',
        'year',
        'file_upload_id',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return (new \Spatie\Activitylog\LogOptions)->logFillable();
    }
}
