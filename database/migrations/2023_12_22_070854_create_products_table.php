<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->double('purchase_price');
            $table->double('sale_price');
            $table->integer('quantity')->nullable()->default(0);
            $table->integer('low_stock_alert')->default(0);
            $table->string('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
