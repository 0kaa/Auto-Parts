<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTapPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tap_payments', function (Blueprint $table) {
            $table->id();
            $table->string('charge_id');
            $table->string('amount');
            $table->string('status');
            // order-id
            // $table->bigInteger('order_id')->unsigned();
            // $table->foreign('order_id')->references('id')->on('orders');
            $table->morphs('orderable');

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
        Schema::dropIfExists('tap_payments');
    }
}
