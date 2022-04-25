<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceOfferItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_offer_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('price_offer_id');
            $table->unsignedBigInteger('custom_order_item_id');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('price');
            
            $table->foreign('price_offer_id')->references('id')->on('price_offers')->onDelete('cascade');
            $table->foreign('custom_order_item_id')->references('id')->on('custom_order_items')->onDelete('cascade');

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
        Schema::dropIfExists('price_offer_items');
    }
}
