<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('advertiser_id');
            $table->unsignedBigInteger('user_id');
            $table->string('advert_name', 150);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('file_name');
            $table->integer('balance');
            $table->integer('view_count');
            $table->string('status', 10);
            $table->timestamps();

            $table->foreign('advertiser_id')->references('id')->on('advertisers')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
}
