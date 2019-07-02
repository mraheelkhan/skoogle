<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('organization_id')->default(0)->comment('0 = individual, no company');
            $table->string('job_title');
            $table->date('deadline');
            $table->text('description');
            $table->string('salary_range');
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
        Schema::dropIfExists('jobs');
    }
}
