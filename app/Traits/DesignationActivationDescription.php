<?php

namespace App\Traits;

use App\Enums\DesignationCodeEnums;

trait DesignationActivationDescription
{
    public static function getDesignationCodeForActivation($status)
    {
        if ($status == DesignationCodeEnums::Initiated->value) {
            return 'Designation is awaiting approval from Checker.';
        }elseif ($status == DesignationCodeEnums::Pending->value) {
            return 'Designation has been approved by Checker.';
        }elseif ($status == DesignationCodeEnums::Approved->value) {
            return 'Designation has been approved by Admin.';
        }elseif ($status == DesignationCodeEnums::Rejected->value) {
            return 'Designation has been rejected by Admin.';
        }else{
            return '';
        }
    }
}
