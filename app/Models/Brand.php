<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
        'meta_title',
        'meta_description'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    // Accessors
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/brands/' . $this->image) : asset('images/no-image.png');
    }

    public function getLogoAttribute()
    {
        return $this->getImageUrlAttribute();
    }
}
