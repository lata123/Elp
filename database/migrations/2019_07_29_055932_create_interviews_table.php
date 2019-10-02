<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zoom_interviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->string('time');
            $table->string('user_id');
            $table->string('zoom_meeting_id');
            $table->string('zoom_host_id');
            $table->dateTime('zoom_start_time');
            $table->text('zoom_start_url');
            $table->text('zoom_registration_url');
            $table->string('zoom_registrant_id');
            $table->text('zoom_join_url');
            $table->string('status')->default(1);
            $table->string('notification_status')->default(0);
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
        Schema::dropIfExists('zoom_interviews');
    }
}
