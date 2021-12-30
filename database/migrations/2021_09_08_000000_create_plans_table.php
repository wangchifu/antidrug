<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('year');//年度
            $table->string('school_code')->nullable();//學校代碼
            $table->unsignedInteger('user_id');//上傳者
            $table->string('file')->nullable();//上傳的檔案
            $table->tinyInteger('status');//狀況：0暫存，1送審，2退件，3覆審，4通過
            $table->unsignedInteger('review_user_id')->nullable();//審核者
            $table->string('review_desc')->nullable();//審核說明
            $table->timestamp('reviewed_at')->nullable();//審核時間
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
        Schema::dropIfExists('plans');
    }
}
