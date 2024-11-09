<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaction extends Model
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
        'course_name',
        'round',
        'counselling_round',
        'counselling_id_roll_no',
        'counselling_activity',
        'trans_id',
        'transaction_date',
        'transaction_amount',
        'amount',
        'remark',
        'paid_status',
        'cancelled_status',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return (new \Spatie\Activitylog\LogOptions)->logFillable();
    }
}









