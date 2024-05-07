<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\PaymentForm;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'user_id',
        'payment_form',
        'status',
    ];

    protected $cast = [
        'status' => OrderStatus::class,
        'payment_form' => PaymentForm::class,
    ];

    protected static function booted(): void
    {
        static::creating(fn (self $entity) => $entity->user_id = auth()->id());
    }

    /**
     * Additional `amount` field.
     * 
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function amount(): Attribute
    {
        return new Attribute(
            get: fn () => $this->items()->sum('product_price')
        );
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
