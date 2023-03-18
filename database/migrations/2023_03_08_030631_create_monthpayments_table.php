<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthpaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthpayments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('direccion_id');
            $table->integer('capture_month');
            $table->integer('capture_year');
            $table->integer('paid');
            $table->string('description');
            $table->foreign('direccion_id')->references('id')->on('direcciones')->cascadeOnDelete();
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
        Schema::dropIfExists('monthpayments');
    }
}
