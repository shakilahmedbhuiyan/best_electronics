<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'variation'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

//    public function getImageAttribute($value)
//    {
//        return $value ? asset($value) : null;
//    }
}
