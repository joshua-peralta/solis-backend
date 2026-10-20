<?php

namespace App\GraphQL\Builders;

use Illuminate\Database\Eloquent\Builder;

class ProductBuilder
{
    /**
     * Filter products by roast level via variants relationship.
     */
    public function filterByRoast(Builder $query, ?string $roast): Builder
    {
        if (! $roast) {
            return $query;
        }

        return $query->whereHas('variants', function (Builder $variantQuery) use ($roast) {
            $variantQuery->where('roast_level', $roast);
        });
    }

    /**
     * Filter products by coffee processing method (Natural, Washed).
     */
    public function filterByProcess(Builder $query, ?string $process): Builder
    {
        if (! $process) {
            return $query;
        }

        return $query->where('process_type', $process);
    }
}