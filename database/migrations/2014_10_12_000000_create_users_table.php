<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('verification_code')->nullable();
            $table->integer('approved')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('image')->nullable();
            $table->string('password');
            $table->boolean('is_notify')->default(true);
            // data company
            $table->string('name_company')->nullable();
            $table->string('name_owner_company')->nullable();
            $table->string('national_identity')->nullable();
            $table->date('date')->nullable();
            $table->string('file')->nullable();
            $table->string('ibn')->nullable();
            $table->enum('is_company_facility_agent', array('yes', 'no'))->nullable();  // هل المنشأة وكيل لأحد الشركات ؟
            $table->enum('is_company_facility_authorized_distributor', array('yes', 'no'))->nullable();   // هل المنشأة موزع معتمد ؟
            $table->enum('other_branches', array('yes', 'no'))->nullable();   //  هل يوجد لديك فروع أخرىد ؟
            $table->string('commercial_register_id')->nullable(); // السجل التجاري
            // end data company
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
