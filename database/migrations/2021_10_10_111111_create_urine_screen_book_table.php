<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrineScreenBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urine_screen_books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');//上傳者
            $table->string('school_code')->nullable();//學校代碼
            $table->string('date');//宣導日期
            $table->string('reagent_brand');//廠牌
            $table->string('reagent_type');//種類
            $table->string('quantity');//quantity
            $table->unsignedInteger('negative');//陰Negative
            $table->unsignedInteger('positive');//陽positive
            $table->unsignedInteger('remain');
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
        Schema::dropIfExists('urine_screen_books');
    }
}
