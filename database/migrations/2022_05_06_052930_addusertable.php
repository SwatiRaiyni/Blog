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
        Schema::table('users', function (Blueprint $table) {

            $table->text('two_factor_recovery_codes') ->after('password')->nullable();
            $table->timestamp('Lockout_End') ->after('two_factor_recovery_codes')->nullable();
            $table->integer('LockCount') ->after('Lockout_End')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'Lockout_End',
                'two_factor_recovery_codes',
                'LockCount'
            ]));
        });
    }
};
