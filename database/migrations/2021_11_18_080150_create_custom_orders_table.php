<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id();

            $table->string('piece_name');
            $table->string('piece_image')->nullable();
            $table->string('piece_description')->nullable();
            $table->string('piece_price')->nullable();
            $table->string('form_image')->nullable();
            $table->string('note')->nullable();
            $table->string('payment_url')->nullable();

            $table->unsignedBigInteger('activity_type_id')->nullable();
            $table->foreign('activity_type_id')->references('id')->on('activities_type');

            $table->unsignedBigInteger('sub_activity_id')->nullable();
            $table->foreign('sub_activity_id')->references('id')->on('sub_activities');

            $table->unsignedBigInteger('sub_sub_activity_id')->nullable();
            $table->foreign('sub_sub_activity_id')->references('id')->on('sub_activities');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('seller_id')->nullable();
            $table->foreign('seller_id')->references('id')->on('users');

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
        Schema::dropIfExists('custom_orders');
    }
}
