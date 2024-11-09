<?php

namespace App\Traits;

use App\Enums\ProcedureCodeEnums;

trait ProcedureActivationDescription
{
    public static function getProcedureCodeForActivation($status)
    {
        if ($status == ProcedureCodeEnums::Initiated->value) {
            return 'Procedure is awaiting approval from Checker.';
        }elseif ($status == ProcedureCodeEnums::Pending->value) {
            return 'Procedure has been approved by Checker.';
        }elseif ($status == ProcedureCodeEnums::Approved->value) {
            return 'Procedure has been approved by Admin.';
        }elseif ($status == ProcedureCodeEnums::Rejected->value) {
            return 'Procedure has been rejected by Admin.';
        }else{
            return '';
        }
    }
}
