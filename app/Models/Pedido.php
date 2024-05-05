<?php

namespace App\Models;

use App\Enums\FormaPagamento;
use App\Enums\PedidoStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'usuario_id',
        'valor',
        'forma_pagamento',
        'status'
    ];

    protected $cast = [
        'status' => PedidoStatus::class,
        'forma_pagamento'=> FormaPagamento::class,
    ];

    public function carrinho(): HasMany
    {
        return $this->hasMany(Carrinho::class, 'pedido_id', 'id');
    }

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
