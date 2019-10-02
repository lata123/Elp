<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('meeting_id')->unsigned();
            $table->foreign('meeting_id')->references('id')->on('meetings');
            $table->string('zoom_meeting_id');
            $table->string('zoom_registrant_id');
            $table->text('zoom_join_url');
            $table->dateTime('zoom_start_time');
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
        Schema::dropIfExists('meeting_participants');
    }
}
