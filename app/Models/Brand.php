<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Brand extends Model implements Sitemapable
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status', 'thumbnail', 'slug', 'featured'];

    /*
     * Get the products for the brand.
     */
    public function products()
    {
        return $this->hasMany(Product::class)
            ->where('status', true)
            ->where('quantity', '>', 0)
            ->orderBy('created_at', 'asc');
    }

    /*
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /*
     * Scope a query to only include active brands.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /*
     * Scope a query to only include featured brands.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function getThumbnailUrlAttribute()
    {
        return asset($this->thumbnail);
    }

     public function toSitemapTag(): Url | string | array
    {
        return Url::create(route('index.brand', $this->slug))
            ->addImage($this->thumbnailUrl, $this->name)
            ->setLastModificationDate($this->updated_at)
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            ->setPriority(0.7);
    }

}
