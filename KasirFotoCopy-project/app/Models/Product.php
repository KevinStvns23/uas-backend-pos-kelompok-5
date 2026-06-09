<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'unit_id',
        'discount_id',
        'category_id',
        'sub_category_id',
        'catalog_discount_id',
        'price',
        'stock'
        ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function catalogDiscount()
    {
        return $this->belongsTo(CatalogDiscount::class);
    }
}