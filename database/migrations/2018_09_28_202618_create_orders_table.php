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
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('address_id');
            $table->integer('status_id');
            $table->integer('carrier_id');
            $table->string('comment');
            $table->text('shipping_address');
            $table->decimal('total', 8, 2);
            $table->decimal('total_tax', 8, 2);
            $table->decimal('total_shipping', 8, 2);
            $table->decimal('total_shipping_tax', 8, 2);
            $table->decimal('total_discount', 8, 2);
            $table->decimal('total_discount_tax', 8, 2);
            $table->string('shipping_no')->nullable();
            $table->string('invoice_no')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
