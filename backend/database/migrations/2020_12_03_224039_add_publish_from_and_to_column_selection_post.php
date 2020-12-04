<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublishFromAndToColumnSelectionPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('selection_posts', function (Blueprint $table) {
            $table->dateTime('publish_from')->nullable()->comment('公開開始日時');
            $table->dateTime('publish_to')->nullable()->comment('公開終了日時');
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
            $table->dropColumn(['publish_from', 'publish_to']);
        });
    }
}
