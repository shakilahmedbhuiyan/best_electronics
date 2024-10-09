<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'grand_total',
        'payment_method',
        'payment_status',
        'notes',
        'transaction_id',
        'shipping_address',
        'item_count',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity', 'price');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }



}
