<?php

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("productName");
            $table->timestamps();
        });

        Schema::create('store_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Store::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->integer('quantity');
            $table->decimal('price',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('store_inventories');
    }
};
