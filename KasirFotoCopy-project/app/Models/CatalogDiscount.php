<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogDiscount extends Model
{
    use HasFactory;

    protected $table = 'catalog_discounts';

    protected $fillable = ['promo_name', 'percentage', 'is_active'];

    public function products()
    {
        return $this->hasMany(Product::class, 'catalog_discount_id');
    }
}