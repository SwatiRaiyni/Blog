<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Title_en', 255)->nullable();
            $table->text('Description_en')->nullable();
            $table->string('Image_en')->nullable();
            $table->date('start_date_en')->nullable();
            $table->date('end_date_en')->nullable();
            $table->boolean('Isactive_en')->default('1');
            $table->bigInteger('user_id_en')->unsigned()->nullable();
            $table->foreign('user_id_en')->references('id')->on('users');
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
        Schema::dropIfExists('user_post');
    }
};
