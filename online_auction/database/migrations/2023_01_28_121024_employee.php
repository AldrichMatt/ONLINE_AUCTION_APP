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
        schema::create('employee', function (Blueprint $table) {
            $table->integer('employee_id', true);
            $table->string('employee_name', 30);
            $table->string('username', 30)->unique('username');
            $table->string('password', 30);
            $table->integer('level');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
