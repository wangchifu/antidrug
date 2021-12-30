<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducatorPropagandaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educator_propagandas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');//上傳者
            $table->string('school_code')->nullable();//學校代碼
            $table->string('title');//宣導主題
            $table->string('lecture');//講座
            $table->string('date');//宣導日期
            $table->string('place');//宣導地點
            $table->unsignedInteger('teacher_times');//教師人次
            $table->unsignedInteger('student_times');//學生人次
            $table->text('content');//檢討建議
            $table->unsignedInteger('feedback');//回饋單
            $table->unsignedInteger('q_1_1');//問題1-1
            $table->unsignedInteger('q_1_2');
            $table->unsignedInteger('q_1_3');
            $table->unsignedInteger('q_1_4');
            $table->unsignedInteger('q_1_5');
            $table->unsignedInteger('q_2_1');//問題2-1
            $table->unsignedInteger('q_2_2');
            $table->unsignedInteger('q_2_3');
            $table->unsignedInteger('q_2_4');
            $table->unsignedInteger('q_2_5');
            $table->unsignedInteger('q_3_1');//問題3-1
            $table->unsignedInteger('q_3_2');
            $table->unsignedInteger('q_3_3');
            $table->unsignedInteger('q_3_4');
            $table->unsignedInteger('q_3_5');
            $table->unsignedInteger('q_4_1');//問題4-1
            $table->unsignedInteger('q_4_2');
            $table->unsignedInteger('q_4_3');
            $table->unsignedInteger('q_4_4');
            $table->unsignedInteger('q_4_5');
            $table->unsignedInteger('q_5_1');//問題5-1
            $table->unsignedInteger('q_5_2');
            $table->unsignedInteger('q_5_3');
            $table->unsignedInteger('q_5_4');
            $table->unsignedInteger('q_5_5');
            $table->unsignedInteger('q_6_1');//問題6-1
            $table->unsignedInteger('q_6_2');
            $table->unsignedInteger('q_6_3');
            $table->unsignedInteger('q_6_4');
            $table->unsignedInteger('q_6_5');
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
        Schema::dropIfExists('educator_propagandas');
    }
}
