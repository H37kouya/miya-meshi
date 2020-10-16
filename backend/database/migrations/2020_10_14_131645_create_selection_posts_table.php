<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', '50')->comment('タイトル');
            $table->string('description', '50')->nullable()->comment('一言コメント');
            $table->longText('contents')->nullable()->comment('メインコンテンツ');
            $table->string('image', 255)->nullable()->comment('サムネイル画像');
            $table->boolean('release')->default(false)->comment('公開設定');
            $table->softDeletes();
            $table->timestamps();

            $table->index('release');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selection_posts');
    }
}
