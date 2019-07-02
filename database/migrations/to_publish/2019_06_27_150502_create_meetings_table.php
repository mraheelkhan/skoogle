<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('location')->nullable();
            $table->integer('meeting_type')->comment('1 = one to one, 2 = group meeting');
            $table->date('meeting_date');
            $table->integer('isActive')->default(1)->comment('0 = inactive , 1 = active');
            $table->integer('status')->default(1)->comment('0 = pending , 1 = display, 2 = moderate, 3 = marked as spam');
            $table->integer('is_deleted')->default(0)->comment('0 = not deleted , 1 = deleted');
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
        Schema::dropIfExists('meetings');
    }
}
