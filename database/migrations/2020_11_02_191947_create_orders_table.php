<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->integer('mobile');
            $table->integer('time');
            $table->string('date');
            $table->integer('product_id');
            $table->integer('number_product');
            $table->string('payment_status',20);
            $table->string('RefId',20);
            $table->string('saleReferenceId',20)->nullable();
            $table->string('zip_code',20)->nullable();
            $table->text('address')->nullable();
            $table->string('order_read',20);
            $table->integer('total_price');
            $table->integer('price');
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
