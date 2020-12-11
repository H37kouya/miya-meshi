<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('shop_id');
            $table->string('name', 100)->comment('店舗名');
            $table->string('name_kana', 100)->nullable()->comment('店舗名かな');
            $table->string('prefix_name', 100)->nullable()->comment('店舗肩書き');
            $table->string('description', 255)->nullable()->comment('一言紹介');
            $table->string('intro', 255)->nullable()->comment('長文紹介');

            $table->unsignedInteger('pref_code')->nullable()->comment('都道府県コード');
            $table->string('address', 255)->nullable()->comment('住所');
            $table->string('building_name', 100)->nullable()->comment('建物名');
            $table->string('tel', 30)->nullable()->comment('電話番号');
            $table->string('postal', 30)->nullable()->comment('郵便番号');
            $table->float('location_latitude', 15, 12)->comment('位置情報');
            $table->float('location_longitude', 15, 12)->comment('位置情報');

            $table->string('facebook_link', 255)->nullable()->comment('Facebook URL');
            $table->string('homepage_link', 255)->nullable()->comment('Homepage URL');
            $table->string('insta_link', 255)->nullable()->comment('Instagram URL');
            $table->string('line_link', 255)->nullable()->comment('Line URL');
            $table->string('twitter_link', 255)->nullable()->comment('Twitter URL');
            $table->string('ubereats_link', 255)->nullable()->comment('Ubereats URL');
            $table->string('youtube_link', 255)->nullable()->comment('Youtube URL');
            $table->string('gotoeat_link', 255)->nullable()->comment('Go To Eat URL');

            $table->string('price_range', 255)->nullable()->comment('価格帯');

            $table->time('business_start_hour1')->nullable()->comment('営業開始時間1');
            $table->time('business_end_hour1')->nullable()->comment('営業終了時間1');
            $table->time('business_lo_hour1')->nullable()->comment('ラストオーダー1');
            $table->time('business_start_hour2')->nullable()->comment('営業開始時間2');
            $table->time('business_end_hour2')->nullable()->comment('営業終了時間2');
            $table->time('business_lo_hour2')->nullable()->comment('ラストオーダー2');
            $table->time('business_start_hour3')->nullable()->comment('営業開始時間3');
            $table->time('business_end_hour3')->nullable()->comment('営業終了時間3');
            $table->time('business_lo_hour3')->nullable()->comment('ラストオーダー3');

            $table->string('parking_lot', 255)->nullable()->comment('駐車場');
            $table->string('seat', 255)->nullable()->comment('座席');
            $table->string('access', 255)->nullable()->comment('交通アクセス');
            $table->string('regular_holiday', 255)->nullable()->comment('定休日');
            $table->unsignedSmallInteger('reservervation_max_number')->nullable()->comment('予約最大人数');
            $table->string('credit_card', 255)->nullable()->comment('クレジットカード');
            $table->string('electronic_money', 255)->nullable()->comment('電子マネー');
            $table->string('about_smoking', 255)->nullable()->comment('禁煙・喫煙');
            $table->string('total_number_of_seats', 255)->nullable()->comment('総席数');
            $table->string('private_room', 255)->nullable()->comment('個室');
            $table->boolean('can_takeout')->default(true)->comment('テイクアウト可能');
            $table->boolean('can_gotoeat')->default(false)->comment('Go To Eat実施店舗かどうか');
            $table->boolean('can_reservation')->default(false)->comment('予約可能かどうか');
            $table->string('period_of_time', 255)->nullable()->comment('時間帯');

            $table->unsignedInteger('insta_number')->nullable()->comment('インスタ番号');
            $table->string('insta_shop_link')->nullable()->comment('インスタリンク');
            $table->longText('insta_iframe')->nullable()->comment('インスタ Iframe');

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
        Schema::dropIfExists('shop_information');
    }
}
