<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Product extends Model implements Sitemapable
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

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeSale($query)
    {
        return $query->where('sale', true);
    }

    public function toSitemapTag(): Url | string | array
    {
        return Url::create(route('product.single', $this->slug))
            ->addImage($this->thumbnail)
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
            ->setPriority(1.0);
    }
}
