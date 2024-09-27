<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'link',
        'status',
    ];

     public function scopeActive($query)
    {
        return $query->where('status', true);
    }

     public function getThumbnailUrlAttribute()
    {
        return asset($this->image);
    }
}
