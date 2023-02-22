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
        schema::create('items', function (Blueprint $table) {
            $table->integer('item_id', true);
            $table->string('item_name', 30);
            $table->string('company_name', 150);
            $table->string('location', 30);
            $table->string('image', 256);
            $table->date('input_date');
            $table->integer('initial_price');
            $table->mediumText('description');
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
