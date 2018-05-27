<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAPPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ap_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code');
            $table->string('payment_number');
            $table->date('payment_date');
            $table->decimal('payment_amount',20,4);
            $table->integer('upload_id');
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
        Schema::dropIfExists('ap_payments');
    }
}
