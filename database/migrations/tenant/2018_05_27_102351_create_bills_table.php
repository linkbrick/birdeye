<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->nullable()->unsigned()->index();
            $table->string('vendor_code')->nullable();
            $table->string('vendor_name')->nullable();
            $table->string('bill_number')->nullable();
            $table->date('bill_date');
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
        Schema::dropIfExists('bills');
    }
}
