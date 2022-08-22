<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_products', function (Blueprint $table) {
            $table->id();
            $table->integer('offer_id');
            $table->integer('product_id');
            $table->string('offer_price');
            $table->string('offer_quantity');
            $table->string('unit');
            $table->string('offer_total');
            $table->integer('offer_tax')->default(0);
            $table->string('offer_discount')->default('0');
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
        Schema::dropIfExists('offer_products');
    }
};
