<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Menambahkan foreign key untuk relasi kategori dan diskon katalog
            $table->foreignId('category_id')->nullable()->after('name')->constrained('categories')->nullOnDelete();
            $table->foreignId('sub_category_id')->nullable()->after('category_id')->constrained('sub_categories')->nullOnDelete();
            $table->foreignId('catalog_discount_id')->nullable()->after('discount_id')->constrained('catalog_discounts')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_category_id']);
            $table->dropForeign(['catalog_discount_id']);
            
            $table->dropColumn(['category_id', 'sub_category_id', 'catalog_discount_id']);
        });
    }
};