<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_work', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('experience_id');
            $table->integer('work_id');
            $table->timestamps();
            $table->foreign('experience_id')->references('id')->on('experiences');
            $table->foreign('work_id')->references('id')->on('works');

            $table->unique(['experience_id', 'work_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiences_works');
    }
}
