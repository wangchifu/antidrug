<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTzuchiPropagandaPicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tzuchi_propaganda_pics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('tzuchi_propaganda_id');
            $table->string('pic');
            $table->string('pic_desc')->nullable();
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
        Schema::dropIfExists('tzuchi_propaganda_pics');
    }
}
