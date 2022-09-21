<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFullDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_full_data', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('lastName')->nullable();
            $table->string('middleName')->nullable();
            $table->text('contact')->nullable();
            $table->text('address')->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->text('mainSkills')->nullable();
            $table->text('education')->nullable();
            $table->text('workLocation')->nullable();
            $table->text('jobTitle')->nullable();
            $table->text('achievements')->nullable();
            $table->text('personalQualities')->nullable();
            $table->text('other')->nullable();
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
        Schema::dropIfExists('user_full_data');
    }
}
