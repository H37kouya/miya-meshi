<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Enum\Models\FirebaseShopModel;
use App\Http\Controllers\Controller;
use App\Models\FirebaseShop;
use App\Support\Arr;
use App\Usecases\GetShopMenusAllUsecase;
use App\Usecases\GetShopUsecase;
use Illuminate\Http\Request;

class ShowShopController extends Controller
{
    private GetShopUsecase $_getShopUsecase;

    private GetShopMenusAllUsecase $_getShopMenusAllUsecase;

    public function __construct(
        GetShopUsecase $getShopUsecase,
        GetShopMenusAllUsecase $getShopMenusAllUsecase
    ) {
        $this->_getShopUsecase = $getShopUsecase;
        $this->_getShopMenusAllUsecase = $getShopMenusAllUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId)
    {
        $shop = $this->_getShopUsecase->invoke($shopId, false);

        $firebaseShopId = Arr::get(
            FirebaseShop::whereShopId($shopId)->first([FirebaseShopModel::firebase_shop_id]),
            FirebaseShopModel::firebase_shop_id
        );

        $shopMenus = $this->_getShopMenusAllUsecase->invoke($shopId, false);

        return Arr::camel_keys([
            "data" => array_merge(
                $shop,
                [ FirebaseShopModel::firebase_shop_id => $firebaseShopId ],
                [ 'shop_menus' => $shopMenus ]
            )
        ]);
    }
}
