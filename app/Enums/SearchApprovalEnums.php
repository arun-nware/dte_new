<?php

namespace App\Enums;

enum SearchApprovalEnums: string
{
    case PaymentApproval = 'Payment Approval';
    case ProcedureCode = 'Procedure Code';
    //    case ApplicationUser = 'Application User';
    case DesignationCode = 'Designation Code';
    case Employee = 'Employee';
    case MonthlyReports = 'Monthly Reports';
}
