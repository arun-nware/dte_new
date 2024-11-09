<?php

namespace App\Traits;

use App\Enums\EmployeeProcessEnums;

trait EmployeeActivationDescription
{
    public static function getEmployeeDescriptionForActivation($status)
    {
        if ($status == EmployeeProcessEnums::Pending->value) {
            return 'Employee is awaiting approval from Checker.';
        }elseif ($status == EmployeeProcessEnums::Approval->value) {
            return 'Employee has been approved by Checker.';
        }elseif ($status == EmployeeProcessEnums::Approved->value) {
            return 'Employee has been approved by Approver.';
        }elseif ($status == EmployeeProcessEnums::Rejected->value) {
            return 'Employee has been rejected by Approver.';
        }else{
            return '';
        }
    }

    public static function getEmployeeStatus($status): string
    {
        if ($status == EmployeeProcessEnums::Pending->value) {
            return '<span class="badge badge-warning">'.EmployeeProcessEnums::Pending->value.'</span>';
        }elseif ($status == EmployeeProcessEnums::Approval->value) {
            return '<span class="badge badge-info">'.EmployeeProcessEnums::Approval->value.'</span>';
        }elseif ($status == EmployeeProcessEnums::Approved->value) {
            return '<span class="badge badge-success">'.EmployeeProcessEnums::Approved->value.'</span>';
        }elseif ($status == EmployeeProcessEnums::Rejected->value) {
            return '<span class="badge badge-danger">'.EmployeeProcessEnums::Rejected->value.'</span>';
        }else{
            return '';
        }
    }
}
