<?php

namespace App\Http\Controllers\Api\Client\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FetchInstaController extends Controller
{
    //以下どういう処理が流れてるの...?
    public function __invoke(Request $request)
    {
        $limit = $request->query('limit', '10');
        $shops = Shop::with([
            "shopInformation"
            => function ($query) {
                $query->orderBy("insta_number", "desc"); //instaNumberに関して降順で取得する
            }, "images"
            => function ($query) {
                $query->where("imageable_name", "image_link");
            }
        ])->nowPublicPosts(Carbon::now())->limit($limit)->get(); //現在公開中のshopを$requestで指定された件数まで取得する
        return $shops;
    } //withはリレーション先を読み込む
}
