<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experience_technology', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('experience_id');
            $table->integer('technology_id');
            $table->timestamps();

            $table->foreign('experience_id')->references('id')->on('experiences');
            $table->foreign('technology_id')->references('id')->on('technologies');
            $table->unique(['experience_id', 'technology_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('experiences_technologies');
    }
}
