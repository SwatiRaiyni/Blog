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

            $table->string('Title_hi',255)->after('Title_en')->nullable();
            $table->text('Description_hi')->after('Description_en')->nullable();
            $table->string('Image_hi')->after('Image_en')->nullable();
            $table->date('start_date_hi')->after('start_date_en')->nullable();
            $table->date('end_date_hi')->after('end_date_en')->nullable();
            $table->boolean('Isactive_hi')->after('Isactive_en')->default('1');
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
                'Title_hi',
                'Description_hi',
                'Image_hi',
                'start_date_hi',
                'end_date_hi',
                'Isactive_hi',

            ]));
        });
    }
};
