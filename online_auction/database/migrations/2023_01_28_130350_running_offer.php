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
        schema::create('running_offers', function (Blueprint $table) {
            $table->integer('offer_id', true);
            $table->integer('auction_id')->index('auction_id')->references('auction_id')->on('auctions');
            $table->integer('user_id')->index('user_id')->references('user_id')->on('users');
            $table->dateTime('offer_datetime');
            $table->bigInteger('offer_price');
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
