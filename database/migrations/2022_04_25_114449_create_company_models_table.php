<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_models', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('company_sector_id');
            $table->foreign('company_sector_id')->references('id')->on('company_sector');
            $table->timestamps();
        });

        Schema::table('custom_order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('car_model_id')->nullable();
            $table->foreign('car_model_id')->references('id')->on('company_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_models');
    }
}
