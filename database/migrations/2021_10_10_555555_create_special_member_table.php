<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('special_id');
            $table->string('class');
            $table->string('number');
            $table->string('name');
            $table->string('sex');
            $table->unsignedInteger('special_type');
            $table->string('filename')->nullable();
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
        Schema::dropIfExists('special_members');
    }
}
