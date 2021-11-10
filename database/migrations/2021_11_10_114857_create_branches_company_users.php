<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesCompanyUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches_company_users', function (Blueprint $table) {
            $table->id();            
            $table->string('phone');
            $table->text('address');
            $table->unsignedBigInteger('region_id'); //المنطقه
            $table->foreign('region_id')->references('id')->on('regions')
                ->onDelete('cascade');
            $table->unsignedBigInteger('city_id'); // المدينة
            $table->foreign('city_id')->references('id')->on('cities')
                ->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('branches_company_users');
    }
}
