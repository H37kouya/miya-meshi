<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Enum\Models\ShopModel;
use App\Http\Controllers\Controller;
use App\Support\Arr;
use App\Usecases\ConnectShopAndFirebaseShopUsecase;
use App\Usecases\UpdateShopUsecase;
use Illuminate\Http\Request;

class UpdateShopController extends Controller
{
    private ConnectShopAndFirebaseShopUsecase $_connectShopAndFirebaseShopUsecase;
    private UpdateShopUsecase $_updateShopUsecase;

    public function __construct(
        ConnectShopAndFirebaseShopUsecase $connectShopAndFirebaseShopUsecase,
        UpdateShopUsecase $updateShopUsecase
    ) {
        $this->_connectShopAndFirebaseShopUsecase = $connectShopAndFirebaseShopUsecase;
        $this->_updateShopUsecase = $updateShopUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId)
    {
        $firebaseShopId = $request->get('firebase_shop_id');

        $shop = $this->_updateShopUsecase->invoke($shopId, Arr::snake_keys($request->all()));

        if ($firebaseShopId) {
            $this->_connectShopAndFirebaseShopUsecase->invoke(
                $shop[ShopModel::id],
                $firebaseShopId
            );
        }

        return Arr::camel_keys([
            'data' => array_merge($shop, [
                'firebase_shop_id' => $firebaseShopId
            ]),
        ]);
    }
}
