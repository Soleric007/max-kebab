<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'price',
        'compare_price',
        'image',
        'gallery',
        'badge',
        'featured',
        'rating',
        'review_count',
        'options',
        'description',
        'short_description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'options' => 'array',
            'featured' => 'boolean',
            'is_active' => 'boolean',
            'price' => 'decimal:2',
            'compare_price' => 'decimal:2',
            'rating' => 'decimal:2',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderByDesc('featured')->orderBy('sort_order')->orderBy('name');
    }
}
