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
        schema::create('running_offer', function (Blueprint $table) {
            $table->integer('offer_id', true);
            $table->integer('auction_id')->index('auction_id');
            $table->integer('item_id')->index('item_id');
            $table->integer('user_id')->index('user_id');
            $table->date('offer_date');
            $table->integer('offer_price');
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
