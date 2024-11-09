<?php

namespace App\Enums;

enum EmployeeProcessEnums: string
{
    case Initiated = 'initiated';
    case Pending = 'pending';
    case Approval = 'approval';
    case Approved = 'approved';

    case Rejected = 'rejected';
}
