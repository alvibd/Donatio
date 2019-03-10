<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertiserTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiser_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('advert_id');
            $table->unsignedBigInteger('advertiser_id');
            $table->integer('amount');
            $table->string('status', 10);
            $table->timestamps();

            $table->foreign('advertiser_id')->references('id')->on('advertisers')
                ->onUpdate('cascade');

            $table->foreign('advert_id')->references('id')->on('adverts')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiser_transactions');
    }
}
