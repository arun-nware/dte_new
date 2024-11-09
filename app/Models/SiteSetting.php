<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['app_name', 'copyright', 'time_zone', 'currency', 'favicon', 'logo', 'financial_year'];

}
