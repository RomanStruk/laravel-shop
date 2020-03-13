<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('order_id')->unsigned();
//            $table->foreign('order_id')->references('id')->on('orders');

            $table->enum('method', ['courier', 'novaposhta']);
            $table->integer('shipping_rate')->default(0);

            $table->string('city');
            $table->string('region');
            $table->string('area');
            $table->string('city_ref');

            $table->text('street')->nullable();
            $table->integer('house')->nullable();
            $table->integer('flat')->nullable();

            $table->string('warehouse_ref')->nullable();
            $table->string('warehouse_title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}
