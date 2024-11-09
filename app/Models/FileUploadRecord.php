<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileUploadRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'module_type',
        'file_title',
        'file_name',
        'total_records',
        'total_uploaded',
        'total_failed',
        'created_by',
        'errors',
    ];

    public function scopeSearch($query, $search)
    {
        $query->where('module_type', 'like', "%{$search}%");
        $query->orWhere('file_title', 'like', "%{$search}%");
        $query->orWhere('file_name', 'like', "%{$search}%");
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}
