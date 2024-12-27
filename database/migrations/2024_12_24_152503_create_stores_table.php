<?php

use App\Models\Store;
use App\Models\StoreOwner;
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
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StoreOwner::class)->constrained()->cascadeOnDelete();
            $table->string("storeName");
            $table->float('stars',1)->nullable();
            $table->timestamps();
        });

        Schema::create('store_owner_store', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StoreOwner::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Store::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
        Schema::dropIfExists('store_owner_store');
    }
};
