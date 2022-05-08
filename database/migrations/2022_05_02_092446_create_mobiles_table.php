<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobiles', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('title',400);
            $table->string('card_img');
            $table->double('price',8,2);
            $table->string('weight',12);
            $table->integer('stock')->unsigned();
            $table->string('colors');
            $table->text('images');
            $table->bigInteger('vid');
            $table->string('key',100);
            $table->text('keywords')->nullable();
            $table->string('features',2000);
            $table->string('description',1500);
            $table->string('height',12);
            $table->string('breadth',12);
            $table->tinyInteger('discount');
            $table->string('depth',12);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mobiles');
    }
}
