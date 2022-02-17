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
            $table->integer('stock');
            $table->string('colors');
            $table->string('fabric',50);
            $table->text('images');
            $table->string('bid',50);
            $table->smallInteger('stock_s');
            $table->smallInteger('stock_m');
            $table->smallInteger('stock_l');
            $table->smallInteger('stock_xl');
            $table->smallInteger('stock_2xl');
            $table->smallInteger('stock_3xl');
            $table->smallInteger('stock_4xl');
            $table->smallInteger('stock_5xl');
            $table->longText('product_details');
            $table->string('key',100);
            $table->text('keywords');
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
