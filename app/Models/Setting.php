<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['site_name', 'site_address', 'site_contact', 'site_email', 'weekdays', 'weekends', 'default_date_format', 'shift_hours', 'ticket_print', 'password_reset_interval', 'operational_from', 'operational_to', 'eod_report_time', 'company_name', 'company_address', 'gst_in', 'pan', 'cin', 'hsn_code', 'city_of_supply', 'state_name_code', 'description_service', 'prefix_for_invoice', 'signature_image', 'property_logo', 'status', 'created_by', 'updated_by'];


}
