<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoeActivePicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boe_active_pics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('boe_active_id');
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
        Schema::dropIfExists('boe_active_pics');
    }
}
