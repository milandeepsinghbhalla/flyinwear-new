<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoggersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joggers', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('title',400);
            $table->string('card_img');
            $table->double('price',8,2);
            $table->string('weight',12);
            $table->integer('stock')->unsigned();
            $table->string('colors');
            $table->string('fabric',50);
            $table->text('images');
            $table->string('bid',50);
            $table->smallInteger('stock_s')->unsigned();
            $table->smallInteger('stock_m')->unsigned();
            $table->smallInteger('stock_l')->unsigned();
            $table->smallInteger('stock_xl')->unsigned();
            $table->smallInteger('stock_2xl')->unsigned();
            $table->smallInteger('stock_3xl')->unsigned();
            $table->smallInteger('stock_4xl')->unsigned();
            $table->smallInteger('stock_5xl')->unsigned();
            $table->longText('product_details')->nullable();
            $table->string('key',100);
            $table->text('keywords')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joggers');
    }
}
