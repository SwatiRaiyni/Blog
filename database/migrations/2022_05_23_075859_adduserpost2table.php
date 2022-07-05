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
        Schema::table('user_post', function (Blueprint $table) {
            $table->bigInteger('user_id_hi')->unsigned()->after('user_id_en')->nullable();
            $table->foreign('user_id_hi')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_post', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'user_id_hi',


            ]));
        });
    }
};
