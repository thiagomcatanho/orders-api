<?php

namespace App\Enums;

use App\Traits\EnumFunctions;

enum PedidoStatus: string 
{
    use EnumFunctions;
    
    case PENDENTE = 'pendente';
    case ENVIADO = 'enviado';
    case FINALIZADO = 'finalizado';
    case CANCELADO = 'cancelado';
}