<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelephonePropagandaPicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telephone_propaganda_pics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('telephone_propaganda_id');
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
        Schema::dropIfExists('telephone_propaganda_pics');
    }
}
