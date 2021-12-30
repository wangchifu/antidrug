<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPropagandaPicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_propaganda_pics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('student_propaganda_id');
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
        Schema::dropIfExists('student_propaganda_pics');
    }
}
