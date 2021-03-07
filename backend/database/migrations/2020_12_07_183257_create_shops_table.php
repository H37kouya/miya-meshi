<?php

use App\Enum\DisplayMode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('release')->default(false)->comment('公開設定');
            $table->dateTime('publish_from')->nullable()->comment('公開開始日時');
            $table->dateTime('publish_to')->nullable()->comment('公開終了日時');
            $table->string('display_mode')->default(DisplayMode::NORMAL)->comment('表示モード');
            $table->integer('priority')->default(1)->comment('優先度');
            $table->softDeletes();
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
        Schema::dropIfExists('shops');
    }
}
