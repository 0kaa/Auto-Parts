<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_activity_id')->nullable();
            $table->foreign('sub_activity_id')->references('id')->on('sub_activities')->onDelete('cascade');
            $table->string('name_ar');
            $table->string('name_en');
            $table->enum('type', ['text', 'number', 'date', 'time', 'select', 'checkbox', 'radio', 'range', 'file', 'textarea'])->default('select');
            $table->string('min')->nullable();
            $table->string('max')->nullable();
            $table->string('step')->nullable();
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
        Schema::dropIfExists('attributes');
    }
}
