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
        Schema::create('CMS', function (Blueprint $table) {
            $table->id();
            $table->string('pagename_en',255)->nullable();
            $table->string('pagename_hi',255)->nullable();
            $table->string('Banner_header_en',255)->nullable();
            $table->string('Banner_header_hi',255)->nullable();
            $table->string('Banner_image_en')->nullable();
            $table->string('Banner_image_hi')->nullable();
            $table->string('LeftBlock_image_en')->nullable();
            $table->string('LeftBlock_image_hi')->nullable();
            $table->longText('Rightblock_en')->nullable();
            $table->longText('Rightblock_hi')->nullable();
            $table->longText('Extrablock_en')->nullable();
            $table->longText('Extrablock_hi')->nullable();
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
        Schema::dropIfExists('CMS');
    }
};
