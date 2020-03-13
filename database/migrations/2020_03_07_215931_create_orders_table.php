<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('currency_id')->unsigned()->index();
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');

            $table->integer('exchange_rate');
            $table->integer('surcharge_percentage');
            $table->integer('surcharge_amount');
            $table->integer('foreign_currency_amount');
            $table->double('paid_in_usd', 7, 4);
            $table->integer('discount_percentage')->default(0);
            $table->integer('discount_amount')->default(0);

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
        Schema::dropIfExists('orders');
    }
}
