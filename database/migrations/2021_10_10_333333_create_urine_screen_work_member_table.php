<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrineScreenWorkMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urine_screen_work_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('urine_screen_work_id');
            $table->string('class');
            $table->string('number');
            $table->string('name');
            $table->string('sex');
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
        Schema::dropIfExists('urine_screen_work_members');
    }
}
