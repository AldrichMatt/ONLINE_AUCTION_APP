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
        schema::create('auctions', function (Blueprint $table) {
            $table->integer('auction_id', true);
            $table->integer('item_id')->index('item_id');
            $table->integer('employee_id')->index('employee_id');
            $table->date('auction_date');
            $table->integer('starting_price');
            $table->integer('status');

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
