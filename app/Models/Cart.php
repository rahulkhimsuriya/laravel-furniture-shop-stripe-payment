<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id', 'product_id', 'quantity'];

    protected $appends = ['total_amount'];

    public function getTotalAmountAttribute()
    {
        return round((($this->quantity * $this->product->price) / 100), 2);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
