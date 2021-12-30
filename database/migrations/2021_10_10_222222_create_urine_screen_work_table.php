<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrineScreenWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urine_screen_works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');//上傳者
            $table->string('school_code')->nullable();//學校代碼
            $table->string('date');//宣導日期
            $table->unsignedInteger('positive_boy');//quantity
            $table->unsignedInteger('positive_girl');//陰Negative
            $table->unsignedInteger('confirm_positive_boy');//quantity
            $table->unsignedInteger('confirm_positive_girl');//陰Negative
            $table->tinyInteger('chun_hui');
            $table->string('filename');
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
        Schema::dropIfExists('urine_screen_works');
    }
}
