<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentModeToSelectionPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('selection_posts', function (Blueprint $table) {
            $table->string('content_mode', '50')->comment('コンテンツモード');
            $table->string('link')->comment('リンク');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('selection_posts', function (Blueprint $table) {
            $table->dropColumn(['content_mode', 'link']);
        });
    }
}
