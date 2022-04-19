<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomOrderAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_order_attributes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('attribute_id')->nullable();
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');

            $table->unsignedBigInteger('option_id')->nullable();
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');

            $table->enum('type', ['text', 'number', 'date', 'time', 'select', 'checkbox', 'radio', 'range', 'file', 'textarea'])->default('select');

            $table->string('value')->nullable();

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
        Schema::dropIfExists('custom_order_attributes');
    }
}
