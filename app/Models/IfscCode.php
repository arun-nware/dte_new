<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IfscCode extends Model
{
    use HasFactory;
    protected $fillable = [
        "bank_name",
        "ifsc_code",
        "branch_name",
        "bank_address",
        "city1",
        "city2",
        "state",
        "std_code",
        "phone",
    ];
}
