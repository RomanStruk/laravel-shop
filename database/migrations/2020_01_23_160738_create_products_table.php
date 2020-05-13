<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->tinyInteger('category_id')->unsigned();
            $table->tinyInteger('brand_id')->unsigned()->default(1);
            $table->string('title',255);
            $table->string('alias',255)->unique();
            $table->text('content')->nullable();
            $table->integer('price')->default(0);
            $table->integer('old_price')->default(0)->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('keywords',255)->default(NULL)->nullable();
            $table->string('description',255)->default(NULL)->nullable();
            $table->enum('hit',['0','1'])->default(0)->index();
            $table->bigInteger('visits')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
