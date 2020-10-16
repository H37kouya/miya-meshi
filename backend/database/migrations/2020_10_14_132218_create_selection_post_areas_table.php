<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectionPostAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selection_post_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('selection_post_id');
            $table->string('firebase_area_id', '100')->comment('firebase area id');
            $table->timestamps();

            $table->foreign('selection_post_id')->references('id')->on('selection_posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selection_post_areas');
    }
}
