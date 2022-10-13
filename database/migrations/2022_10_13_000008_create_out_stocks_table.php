<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutStocksTable extends Migration
{
    public function up()
    {
        Schema::create('out_stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
