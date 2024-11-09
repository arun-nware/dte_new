<?php

namespace App\Enums;

enum DesignationCodeEnums: string
{
    case Initiated = 'initiate';
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
