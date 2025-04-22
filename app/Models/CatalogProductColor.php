<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatalogProductColor extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function products()
    {
        return $this->belongsToMany(
            CatalogProduct::class,
            'catalog_product_color_pivots',
            'color_id',
            'product_id'
        )->withTimestamps();
    }
}
