<?php

namespace App\Enums;

use App\Traits\EnumFunctions;

enum FormaPagamento: string
{
    use EnumFunctions;

    case DINHEIRO = 'dinheiro';
    case PIX = 'pix';
    case DEBITO = 'débito';
    case CREDITO = 'crédito';
    case VALE_GAS = 'vale gás';
}