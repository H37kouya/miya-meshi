<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Http\Controllers\Controller;
use App\Models\FirebaseShop;
use App\Usecases\GetShopUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ShowShopController extends Controller
{
    private GetShopUsecase $_getShopUsecase;

    public function __construct(GetShopUsecase $getShopUsecase)
    {
        $this->_getShopUsecase = $getShopUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId)
    {
        $firebaseShopId = Arr::get(
            FirebaseShop::whereShopId($shopId)->first(['firebase_shop_id']),
            'firebase_shop_id'
        );

        return [
            "data" => array_merge(
                $this->_getShopUsecase->invoke($shopId, false),
                [ 'firebase_shop_id' => $firebaseShopId ]
            )
        ];
    }
}
