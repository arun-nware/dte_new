<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'code', 'state_id'];

    public function states()
    {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }
}
