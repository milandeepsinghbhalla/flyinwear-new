<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesktopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desktops', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('title',400);
            $table->string('card_img');
            $table->double('price',8,2);
            $table->string('weight',12);
            $table->integer('stock')->unsigned();
            $table->string('colors');
            $table->text('images');
            $table->string('bid',50)->nullable();
            $table->string('key',100);
            $table->text('keywords')->nullable();
            $table->string("features",2000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('desktops');
    }
}
