<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Scopes\UserScope;
use Carbon\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
    use LogsActivity;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'name',
        'username',
        'email',
        'phone',
        'password',
        'otp_verified_at',
        'designation',
        'district',
        'hospital',
        'employee_code',
        'last_login_at',
        'status',
        'medical_college_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    /*protected static function booted()
    {
        static::addGlobalScope(new UserScope());
    }*/

    public static function updateOptVerifiedAt(): void
    {
        User::find(Auth::user()->id)->update(['otp_verified_at' => Carbon::now()]);
    }

    public static function updateLastLogindAt(): void
    {
        User::find(Auth::user()->id)->update(['last_login_at' => Carbon::now()]);
    }

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

    public function getActivitylogOptions(): LogOptions
    {
        return (new \Spatie\Activitylog\LogOptions)->logFillable();
    }


    public function hospitals()
    {
        return $this->hasOne(Hospital::class, 'hospital_code', 'hospital');
    }
}
