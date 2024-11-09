<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Navigation extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'nav_id',
        'nav_name',
        'nav_route',
        'nav_permission',
        'nav_type',
        'nav_icon',
        'nav_order'
    ];

    public static function navigationList(): array
    {
        $navigations = self::where('nav_type', 'main')->get()->toArray();
        DB::enableQueryLog();
        foreach ($navigations as $key => $navigation)
        {
            $navs = self::where('nav_id', $navigation['id'])->where('nav_type', 'nav')->get()->toArray();
            $navigations[$key]['nav'] = $navs;

            if (count($navs) > 0) {
                foreach ($navs as $keys => $value)
                {
                    $subs = self::where('nav_id', $value['id'])->where('nav_type', 'sub-nav')->get()->toArray();

                    $navigations[$key]['nav'][$keys]['sub'] = $subs;
                }
            }

        }
        return $navigations;
    }

    public function navigation():  HasMany
    {
        return $this->hasMany($this::class, 'nav_id', 'id');
    }
}
