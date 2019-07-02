<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->text('post_content');
            $table->string('post_title');
            $table->date('post_date');
            $table->integer('isComment')->default(0)->comment('0 = off, 1 = on');
            $table->string('post_url')->unique();
            $table->string('post_type')->comment('post, article, job');
            $table->integer('category_id');
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
        Schema::dropIfExists('posts');
    }
}
