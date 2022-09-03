<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtherPropagandaPicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_propaganda_pics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('other_propaganda_id');
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
        Schema::dropIfExists('other_propaganda_pics');
    }
}
