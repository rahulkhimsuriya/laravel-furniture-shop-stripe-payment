<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'payment_intent_id',
        'currency',
        'amount',
        'card_brand',
        'card_last4',
        'receipt_url',
        'status',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class)->latest();
    }
}
