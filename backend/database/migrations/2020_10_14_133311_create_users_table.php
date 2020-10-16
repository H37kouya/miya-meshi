<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('name', '50')->unique()->comment('ユーザー名');
            $table->string('api_token', '80')->unique()->nullable()->default(null)->comment('API Token');
            $table->string('remember_token', '100')->unique()->comment('Remember Token');
            $table->boolean('active')->default(false)->comment('有効なアカウントかどうか');
            $table->timestamps();

            $table->index(['active', 'api_token']);
            $table->index(['active', 'remember_token']);
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
