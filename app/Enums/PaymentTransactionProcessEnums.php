<?php

namespace App\Enums;

enum PaymentTransactionProcessEnums: string
{
    case Created = 'Created';
    case Success = 'Success';
    case Failed= 'Failed';
    case Reinitialized = 'Reinitialized';
    case Rejected = 'Rejected';
}
