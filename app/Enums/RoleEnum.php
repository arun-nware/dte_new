<?php

namespace App\Enums;

enum RoleEnum: string
{
    case SuperAdmin = 'SuperAdmin';
    case Administrator = 'Administrator';
    case Admin = 'Admin';
    case HospitalAdmin = 'HospitalAdmin';
    case Maker = 'Maker';
    case Checker = 'Checker';
    case Approver = 'Approver';
}
