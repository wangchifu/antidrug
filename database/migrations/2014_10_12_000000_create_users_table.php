<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username')->unique();//帳號
            $table->string('name');//姓名
            $table->string('password');//密碼
            $table->string('personid')->nullable();
            $table->tinyInteger('disable')->nullable();//停用？
            $table->tinyInteger('special')->nullable();//是，可於每月反毒宣導績效表填報使用批次匯入功能
            $table->tinyInteger('class')->nullable();//帳號類別：1國小 2國中 3高中職 4政府機關 5民間機構
            $table->tinyInteger('area')->nullable();//國小行政區 0無 1彰化區 2和美區 3鹿港區 4溪湖區 5員林區 6田中區 7北斗區 8二林區 9其他學校
            $table->string('menu')->nullable();//選單顯示
            $table->string('note')->nullable();//備註
            $table->string('email')->nullable();//email
            $table->string('school_code')->nullable();//學校代碼
            $table->string('school_name')->nullable();//學校代碼
            $table->string('type')->nullable();//登入選項 gsuite local
            $table->tinyInteger('admin')->nullable();//1管理者
            $table->string('admin_level')->nullable();//管理者的權限
            $table->timestamp('last_login')->nullable();//上次登入時間
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
        Schema::dropIfExists('users');
    }
}
