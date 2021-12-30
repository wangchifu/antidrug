<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterActiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('center_actives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');//上傳者
            $table->string('school_code')->nullable();//學校代碼
            $table->string('title');//宣導主題
            $table->string('date');//宣導日期
            $table->string('place');//宣導地點
            $table->string('person_times');//宣導人次
            $table->string('filename')->nullable();//檔案
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
        Schema::dropIfExists('center_actives');
    }
}
