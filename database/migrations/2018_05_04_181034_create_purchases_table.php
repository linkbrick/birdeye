<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code');
            $table->string('vendor_code');
            $table->string('vendor_name');
            $table->string('purchase_order_number');
            $table->date('purchase_date');
            $table->decimal('total_before_tax',20,4);
            $table->decimal('tax',20,4);
            $table->decimal('total',20,4);
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
        Schema::dropIfExists('purchases');
    }
}
