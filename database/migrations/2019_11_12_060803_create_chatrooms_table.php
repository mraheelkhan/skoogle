<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chatrooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->comment('created_by');
            $table->string('name')->nullabe();
            $table->string('room_type')->default('single');
            $table->string('logo')->nullable()->default("none");
            $table->integer('status')->default(1);
            $table->integer('is_deleted')->default(0);
            $table->integer('isActive')->default(0);
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
        Schema::dropIfExists('chatrooms');
    }
}
