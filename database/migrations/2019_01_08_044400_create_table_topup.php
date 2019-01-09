<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTopup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_topup', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_wallet');
            $table->float('topup');
            $table->boolean('is_paid');
            $table->integer('unique_code');
            $table->integer('id_pay');
            $table->integer('source');
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
        Schema::dropIfExists('table_topup');
    }
}
