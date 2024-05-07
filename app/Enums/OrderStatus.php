<?php

namespace App\Enums;

use App\Traits\EnumFunctions;

enum OrderStatus: string 
{
    use EnumFunctions;
    
    case PEDING = 'peding';
    case SENT = 'sent';
    case DONE = 'done';
    case CANCELLED = 'cancelled';
}