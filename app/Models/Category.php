<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Menentukan kolom yang boleh diisi
    protected $fillable = ['name', 'description'];

    // Relasi One-to-Many ke SubCategory
    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}