<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    // --- Relationships ---

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    // --- Scopes for GraphQL Filters ---

    public function scopeRoast(Builder $query, ?string $roast): Builder
    {
        if (! $roast) {
            return $query;
        }

        return $query->whereHas('variants', function (Builder $variantQuery) use ($roast) {
            $variantQuery->where('roast_level', $roast);
        });
    }

    public function scopeProcess(Builder $query, ?string $process): Builder
    {
        if (! $process) {
            return $query;
        }

        return $query->where('process_type', $process);
    }
}