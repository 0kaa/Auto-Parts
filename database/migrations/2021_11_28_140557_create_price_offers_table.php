<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_order_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('price');
            $table->string('note')->nullable();
            $table->foreign('custom_order_id')->references('id')->on('custom_orders')->onDelete('cascade');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('price_offers');
    }
}
