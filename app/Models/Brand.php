<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status', 'thumbnail', 'slug', 'featured'];

    /*
     * Get the products for the brand.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
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
}
