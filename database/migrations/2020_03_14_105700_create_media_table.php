<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('path', 255);
            $table->string('extension');
            $table->integer('size');
            $table->string('url', 255);
            $table->enum('visibility', ['private', 'public'])->default('public');
            $table->enum('disc', ['local', 'public'])->default('public');
            $table->string('name',255);
            $table->string('keywords',255)->default(NULL)->nullable();
            $table->string('description',255)->default(NULL)->nullable();
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
        Schema::dropIfExists('media');
    }
}
