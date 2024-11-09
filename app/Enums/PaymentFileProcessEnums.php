<?php

namespace App\Enums;

enum PaymentFileProcessEnums: string
{
    case PAYMENTFUNDRECEIVED = 'Fund Received';
    case PAYMENTTRANSACTIONCREATED = 'Transaction Created';
    case PAYMENTTRANSACTIONAPPROVED= 'Transaction Approved';
    case PAYMENTSENTTOBANK = 'Sent To Bank';
    case PAYMENTSETTLED = 'Settled';
}
