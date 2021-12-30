<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialReagentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_reagents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('special_id');
            $table->string('name');
            $table->string('sex');
            $table->string('depart');
            $table->string('date');
            $table->string('reagent_brand');//廠牌
            $table->string('reagent_type');//種類
            $table->string('result');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('special_reagents');
    }
}
