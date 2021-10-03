<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// ユーザーテーブルを作成
class CreateUsersTable extends Migration
{
    /**
     * テーブルの作成処理
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('nickname')->default('名前が登録されていません');
            $table->string('icon_image')->default('/icon/users/sample.jpg');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * テーブルの削除処理
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
