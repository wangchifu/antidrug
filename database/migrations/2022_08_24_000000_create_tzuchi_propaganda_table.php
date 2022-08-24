<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTzuchiPropagandaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tzuchi_propagandas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id'); //上傳者
            $table->string('school_code')->nullable(); //學校代碼
            $table->string('title'); //宣導主題
            $table->string('lecture')->nullable(); //講座
            $table->string('date'); //宣導日期
            $table->string('place'); //宣導地點
            $table->unsignedInteger('teacher_times'); //教師人次
            $table->unsignedInteger('student_times'); //學生人次
            $table->text('report'); //實施情形
            $table->text('content'); //檢討建議
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
        Schema::dropIfExists('tzuchi_propagandas');
    }
}
