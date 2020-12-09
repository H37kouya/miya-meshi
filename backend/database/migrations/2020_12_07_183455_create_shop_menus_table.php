<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shop_id');

            $table->boolean('release')->default(true)->comment('公開設定');
            $table->dateTime('publish_from')->nullable()->comment('公開開始日時');
            $table->dateTime('publish_to')->nullable()->comment('公開終了日時');
            $table->unsignedInteger('priority')->default(1)->comment('優先度');

            $table->string('name', 255)->comment('メニュー名');
            $table->string('description', 255)->nullable()->comment('メニュー概要');
            $table->string('intro', 255)->nullable()->comment('メニュー紹介文');
            $table->unsignedInteger('price', 255)->nullable()->comment('値段');
            $table->string('period_of_time', 255)->nullable()->comment('時間帯');

            $table->boolean('is_tax_included')->default(true)->comment('税込みかどうか');
            $table->boolean('can_takeout')->default(true)->comment('テイクアウト可能かどうか');

            $table->timestamps();
            $table->foreign('shop_id')->references('id')->on('shops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_menus');
    }
}
