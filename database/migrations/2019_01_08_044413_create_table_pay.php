<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_pay', function (Blueprint $table) {
            $table->increments('id');
            $table->float('total_invoice');
            $table->integer('payment_method');
            $table->boolean('is_confirmed');
            $table->boolean('is_transfered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_pay');
    }
}
