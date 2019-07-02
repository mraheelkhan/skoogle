<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKudosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kudos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('total_projects')->nullable();
            $table->integer('total_answers')->nullable();
            $table->integer('total_profile_likes')->nullable();
            $table->integer('total_classes_teached')->nullable();
            $table->integer('total_comments')->nullable();
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
        Schema::dropIfExists('kudos');
    }
}
