<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'summary',
        'description',
        'sku',
        'price',
        'sale_price',
        'sale',
        'instalment',
        'quantity',
        'thumbnail',
        'featured_image',
        'is_featured',
        'category_id',
        'brand_id',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords'

    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getThumbnailAttribute($value)
    {
        return $value ? asset( $value) : null;
    }

    public function getFeaturedImageAttribute($value)
    {
        return $value ? asset( $value) : null;
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }
}
