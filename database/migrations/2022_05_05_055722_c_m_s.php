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
        Schema::create('c_m_s', function (Blueprint $table) {
        $table->id();
        $table->string('pagename',255);
        $table->string('Banner_header',255);
        $table->string('Banner_image');
        $table->string('LeftBlock_image');
        $table->longText('Rightblock');
        $table->longText('Extrablock');
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

        Schema::dropIfExists('c_m_s');
    }
};
