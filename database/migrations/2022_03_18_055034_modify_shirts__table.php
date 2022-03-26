<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyShirtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('shirts', function (Blueprint $table) {
            $table->string("features",2000);
            $table->string('height',12);
            $table->string('breadth',12);
            $table->string('product_details',1500)->change();
            $table->tinyInteger('discount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('shirts', function (Blueprint $table) {

            $table->dropColumn(array('height', 'breadth', 'discount','features'));
            $table->longText('product_details')->nullable()->change();
            });
    }
}
