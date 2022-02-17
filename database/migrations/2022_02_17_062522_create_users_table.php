<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',70);
            $table->string('email',190)->unique();
            $table->string('password');
            $table->string('role',15);
            $table->string('number',20);
            $table->text('cart')->nullable();
            $table->longText('orders')->nullable();
            $table->longText('wishlist')->nullable();
            $table->longText('address_book')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
