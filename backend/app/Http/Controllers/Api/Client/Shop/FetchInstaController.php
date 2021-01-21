<?php

namespace App\Http\Controllers\Api\Client\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Request;
use Illuminate\Support\Carbon;

class FetchInstaController extends Controller
{
    public function __invoke(Request $request)
    {
        $shops = Shop::with([
            "shopInformation"
            => function ($query) {
                $query->orderBy("insta_number", "desc"); //instaNumberに関して降順で取得する
            }, "images"
            => function ($query) {
                $query->where("imageable_name", "image_link");
            }
        ])->nowPublicPosts(Carbon::now())->limit(10)->get(); //現在公開中のshopを10件まで取得する
        return $shops;
    } //withはリレーション先を読み込む
}
