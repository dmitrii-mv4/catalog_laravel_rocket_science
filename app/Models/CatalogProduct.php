<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatalogProduct extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function category()
    {
        return $this->belongsTo(CatalogCategory::class);
    }

    public function colors()
    {
        return $this->belongsToMany(
            CatalogProductColor::class,
            'catalog_product_color_pivots',
            'product_id',
            'color_id'
        )->withTimestamps();
    }

    public function scopeApplyFilters($query, $request)
    {
        return $query->when($request->has('min_price') && $request->has('max_price'), function($q) use ($request) {
                $q->whereBetween('price', [$request->min_price, $request->max_price]);
            })
            ->when($request->has('categories'), function($q) use ($request) {
                $q->whereIn('category_id', $request->categories);
            })
            ->when($request->has('colors'), function($q) use ($request) {
                $q->whereHas('colors', function($query) use ($request) {
                    $query->whereIn('id', $request->colors);
                });
            });
    }
}
