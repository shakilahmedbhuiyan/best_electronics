<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
        'website',
        'map_link',
        'logo',
        'favicon',

        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'whatsapp',
        'tiktok',

        'seo_image',
        'seo_title',
        'seo_description',
        'keywords',
    ];

//    public function getLogoAttribute($value)
//    {
//        return $value ? asset($value) : null;
//    }

    public function getFaviconAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getSeoImageAttribute($value)
    {
        return $value ? asset($value) : null;
    }

    public function getSocailLinksAttribute()
    {
        return [
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'youtube' => $this->youtube,
            'tiktok' => $this->tiktok,
        ];
    }

    public function getSeoAttribute()
    {
        return [
            'title' => $this->seo_title,
            'description' => $this->seo_description,
            'image' => $this->seo_image,
            'keywords' => $this->keywords,
        ];
    }

    public function getCompanyAttribute()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone' => $this->phone,
             'whatsapp' => $this->whatsapp,
            'email' => $this->email,
            'website' => $this->website,
            'map_link' => $this->map_link,
        ];
    }

}
