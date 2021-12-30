<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoeActiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boe_actives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');//上傳者
            $table->string('school_code')->nullable();//學校代碼
            $table->string('title');//宣導主題
            $table->string('date');//宣導日期
            $table->unsignedInteger('object');//宣導對象
            $table->unsignedInteger('type');//宣導類別
            $table->string('personnel');//宣導人員
            $table->string('place');//宣導地點
            $table->string('person_times');//宣導人次
            $table->string('times');//宣導場次
            $table->text('content');//宣導內容
            $table->text('result');//宣導成效
            $table->string('money_source')->nullable();//經費來源
            $table->string('money')->nullable();//經費總額
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
        Schema::dropIfExists('boe_actives');
    }
}
