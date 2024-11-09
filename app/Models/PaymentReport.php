<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'course',
        'user_name',
        'inst_name',
        'total_intake',
        'total_allotted',
        'total_admission_cancelled',
        'total_upgraded_admission_cancelled',
        'total_admission',
        'total_nri',
        'total_ips',
        'total_tfw',
        'total_pio',
        'total_upgrade_count',
        'total_upgrade_allotment',
        'total_upgrade',
        'total_clc_cancelled',
        'total_nenv',
        'year',
        'admission1',
        'admission2',
        'tuition_fee_payment',
        'account_number',
        'account_holder_name',
        'bank',
        'bank_branch',
        'ifsc',
        'nodal_officer_mobile_no',
        'asstt_nodal_officer_mobile_no'
    ];
}
