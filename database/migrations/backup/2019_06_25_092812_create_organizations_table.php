<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('email');
            $table->integer('status')->comment('0 = inactive , 1 = active');
            $table->integer('is_deleted')->default(0)->comment('0 = not deleted , 1 = deleted');
            $table->integer('allowed_outside')->default(1)->comment('users are :: 0 = not allowed , 1 = allowed');
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
        Schema::dropIfExists('organizations');
    }
}
