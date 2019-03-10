<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('withdraw_request_id');
            $table->unsignedBigInteger('non_profit_organization_id');
            $table->unsignedBigInteger('processed_by');
            $table->string('status', 20);
            $table->timestamps();

            $table->foreign('withdraw_request_id')->references('id')->on('withdraw_requests')
                ->onUpdate('cascade');

            $table->foreign('non_profit_organization_id')->references('id')->on('non_profit_organizations')
                ->onUpdate('cascade');

            $table->foreign('processed_by')->references('id')->on('users')
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
        Schema::dropIfExists('withdraw_transactions');
    }
}
