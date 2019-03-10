<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('non_profit_organization_id');
            $table->unsignedBigInteger('manager_id');
            $table->integer('amount');
            $table->integer('tax');
            $table->integer('service_charge');
            $table->timestamps();

            $table->foreign('non_profit_organization_id')->references('id')->on('non_profit_organizations')
                ->onupdate('cascade')->onDelete('cascade');

            $table->foreign('manager_id')->references('id')->on('users')
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
        Schema::dropIfExists('withdraw_requests');
    }
}
