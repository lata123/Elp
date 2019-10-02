<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Admins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
	        $table->string('reset_link')->nullable();
            $table->smallInteger('phone_code')->nullable();
            $table->string('phone_number',20)->unique();
            $table->string('citizen_id')->nullable();
            $table->string('billing_id')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->tinyInteger('role_id');
            $table->boolean('status')->default(1);
            $table->double('points', 8, 2)->nullable();
            $table->double('available_points', 8, 2)->default(0);
            $table->double('pending_points', 8, 2)->default(0);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('admins');
    }
}
