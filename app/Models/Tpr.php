<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tpr extends Model
{
    use HasFactory;


    protected $maps = [
        'user_name' => 'college_code',
        'inst_name' => 'college_name',
        'total_allotted' => 'total_allocated',
        'total_admission_cancelled' => 'total_allocated_cancelled',
        'total_upgraded_admission_cancelled' => 'total_cancelled_upgrade_candidate',
        'total_nri' => 'nri',
        'total_ips' => 'ips',
        'total_tfw' => 'tfw',
        'total_pio' => 'pio',
        'total_upgrade_count' => 'total_upgrade_candidate',
        'total_upgrade_allotment' => 'total_1st_upgrade_candidate',
        'total_upgrade' => 'total_2nd_upgrade_candidate',
        'total_nenv' => 'ne',
        'admission1' => 'admission',
        'admission2' => 'admission_upgrade',
        'tuition_fee_payment' => 'total_amount',

    ];
    // protected $hidden = [
    //     'user_name',
    //     'inst_name',
    //     'total_allotted',
    //     'total_admission_cancelled',
    //     'total_upgraded_admission_cancelled',
    //     'total_nri',
    //     'total_ips',
    //     'total_tfw',
    //     'total_pio',
    //     'total_upgrade_count',
    //     'total_upgrade_allotment',
    //     'total_upgrade',
    //     'total_nenv',
    //     'admission1',
    //     'admission2',
    //     'tuition_fee_payment',

    // ];
    // protected $appends = [
    //     'college_code',
    //     'college_name',
    //     'total_allocated',
    //     'total_allocated_cancelled',
    //     'total_cancelled_upgrade_candidate',
    //     'nri',
    //     'ips',
    //     'tfw',
    //     'pio',
    //     'total_upgrade_candidate',
    //     'total_1st_upgrade_candidate',
    //     'total_2nd_upgrade_candidate',
    //     'ne',
    //     'admission',
    //     'admission_upgrade',
    //     'total_amount',

    // ];
    // protected $visible = [
    //     'college_code',
    //     'college_name',
    //     'total_allocated',
    //     'total_allocated_cancelled',
    //     'total_cancelled_upgrade_candidate',
    //     'nri',
    //     'ips',
    //     'tfw',
    //     'pio',
    //     'total_upgrade_candidate',
    //     'total_1st_upgrade_candidate',
    //     'total_2nd_upgrade_candidate',
    //     'ne',
    //     'admission',
    //     'admission_upgrade',
    //     'total_amount',

    // ];
}
