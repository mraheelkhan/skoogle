<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('project_id');
            $table->text('message_body');
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
        Schema::dropIfExists('project_messages');
    }
}