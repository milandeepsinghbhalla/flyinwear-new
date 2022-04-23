<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigInteger('vid')->primary();
            $table->string('vendor_email',190)->unique();
            $table->string('shop_name',250);
            $table->string('vendor_phn_no',20);
            $table->string('vendor_alternate_phn_no',20)->nullable();
            $table->longText('vendor_address_book');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendors');
    }
}
