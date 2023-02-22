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
        schema::create('auction_histories', function (Blueprint $table) {
            $table->integer('history_id', true);
            $table->integer('auction_id')->index('auction_id');
            $table->integer('item_id')->index('item_id');
            $table->integer('user_id')->index('user_id');
            $table->dateTime('report_date');
            $table->integer('sold_price');
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
