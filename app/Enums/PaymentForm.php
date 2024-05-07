<?php

namespace App\Enums;

use App\Traits\EnumFunctions;

enum PaymentForm: string
{
    use EnumFunctions;

    case CASH = 'cash';
    case PIX = 'pix';
    case DEBIT_CARD = 'debit_card';
    case CREDIT_CARD = 'credit_card';
    case OTHER = 'other';
}