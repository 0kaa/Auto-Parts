<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_order_items', function (Blueprint $table) {
            $table->id();

            $table->string('piece_name');
            $table->string('piece_image')->nullable();
            $table->string('piece_description')->nullable();
            $table->string('piece_price')->nullable();
            $table->string('form_image')->nullable();
            $table->string('note')->nullable();
            $table->integer('quantity')->default(1);

            $table->unsignedBigInteger('custom_order_id');
            $table->unsignedBigInteger('activity_type_id')->nullable();
            $table->unsignedBigInteger('sub_activity_id')->nullable();
            $table->unsignedBigInteger('sub_sub_activity_id')->nullable();
            $table->unsignedBigInteger('car_id')->nullable();

            $table->foreign('custom_order_id')->references('id')->on('custom_orders')->onDelete('cascade');
            $table->foreign('activity_type_id')->references('id')->on('activities_type');
            $table->foreign('sub_activity_id')->references('id')->on('sub_activities');
            $table->foreign('sub_sub_activity_id')->references('id')->on('sub_activities');
            $table->foreign('car_id')->references('id')->on('cars');

            $table->timestamps();
        });

        Schema::table('custom_order_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('custom_order_item_id')->nullable();
            $table->foreign('custom_order_item_id')->references('id')->on('custom_order_items')->onDelete('cascade');
        });      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_order_items');
    }
}
