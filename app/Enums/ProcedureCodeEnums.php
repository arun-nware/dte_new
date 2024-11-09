<?php

namespace App\Enums;

enum ProcedureCodeEnums: string
{
    case Initiated = 'initiate';
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
