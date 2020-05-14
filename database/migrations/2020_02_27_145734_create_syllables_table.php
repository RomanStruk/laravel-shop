<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSyllablesTable extends Migration
{
    /**
     * Run the migrations.
     * склад
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syllables', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->bigInteger('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');

            $table->integer('imported'); // завезено
            $table->integer('remains'); // залишилось
            $table->integer('processed'); // обробляється
            $table->text('description')->nullable(); // примітки
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
        Schema::dropIfExists('syllables');
    }
}
