<?php

namespace App\Http\Controllers\Api\Client\Shop;

use App\Enum\Models\ShopModel;
use App\Http\Controllers\Controller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FetchInstaController extends Controller
{
    public function __invoke(Request $request)
    {
        $limit = $request->query('limit', '10');
        $shops = Shop::with([
<<<<<<< HEAD
            "shopInformation"
            => function ($query) {
                $query->orderBy("insta_number", "desc")->get(); //insta_numberに関して降順で取得する
            }, "images"
=======
            "shopInformation",
            "images"
>>>>>>> f25f00adf8b81eed939b953a95cc16e580037081
            => function ($query) {
                $query->where("imageable_name", "image_link")->get();
            }
        ])
            ->nowPublicPosts(Carbon::now())
            ->select(
                'shops.'.ShopModel::id,
                'shops.'.ShopModel::release,
                'shops.'.ShopModel::publish_from,
                'shops.'.ShopModel::publish_to,
                'shops.'.ShopModel::priority,
                'shops.'.ShopModel::display_mode,
                'shops.'.ShopModel::created_at,
                'shops.'.ShopModel::updated_at,
            )
            ->join('shop_information', 'shop_information.shop_id', '=', 'shops.id')
            ->orderBY('shop_information.insta_number', 'desc')
            ->limit($limit)->get(); //現在公開中のshopを$requestで指定された件数まで取得する
        return $shops;
    } //withはリレーション先を読み込む
}
