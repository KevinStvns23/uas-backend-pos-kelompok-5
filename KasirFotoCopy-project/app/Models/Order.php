<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'invoice_number',
        'total_price'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}