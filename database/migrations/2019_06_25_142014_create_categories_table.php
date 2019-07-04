<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_name');
            $table->integer('parent_category_id')->default(0)->comment(' 0 = no parent');
            $table->string('type')->comment(' project, question, skill, course, video ');
            $table->integer('status')->default(1)->comment('0 = inactive , 1 = active');
            $table->integer('is_deleted')->default(0)->comment('0 = not deleted , 1 = deleted');
            $table->integer('user_id');
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
        Schema::dropIfExists('categories');
    }
}
