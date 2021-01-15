<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Enum\Models\FirebaseShopModel;
use App\Enum\Models\ShopModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Shop\UpdateShopFormRequest;
use App\Support\Arr;
use App\Usecases\ConnectShopAndFirebaseDishUsecase;
use App\Usecases\ConnectShopAndFirebaseKeywordUsecase;
use App\Usecases\ConnectShopAndFirebaseShopUsecase;
use App\Usecases\UpdateShopUsecase;

class UpdateShopController extends Controller
{
    private ConnectShopAndFirebaseShopUsecase $_connectShopAndFirebaseShopUsecase;
    private ConnectShopAndFirebaseKeywordUsecase $_connectShopAndFirebaseKeywordUsecase;
    private UpdateShopUsecase $_updateShopUsecase;
    private ConnectShopAndFirebaseDishUsecase $_connectShopandFirebaseDishUsecase;

    public function __construct(
        ConnectShopAndFirebaseShopUsecase $connectShopAndFirebaseShopUsecase,
        ConnectShopAndFirebaseKeywordUsecase $connectShopAndFirebaseKeywordUsecase,
        UpdateShopUsecase $updateShopUsecase,
        ConnectShopAndFirebaseDishUsecase $connectShopAndFirebaseDishUsecase
    ) {
        $this->_connectShopAndFirebaseShopUsecase = $connectShopAndFirebaseShopUsecase;
        $this->_connectShopAndFirebaseKeywordUsecase = $connectShopAndFirebaseKeywordUsecase;
        $this->_updateShopUsecase = $updateShopUsecase;
        $this->_connectShopandFirebaseDishUsecase = $connectShopAndFirebaseDishUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateShopFormRequest $request, int $shopId)
    {
        $firebaseShopId = $request->getByCamelKey(FirebaseShopModel::firebase_shop_id);
        $firebaseKeywordIds = $request->getByCamelKey('firebase_keyword_ids', []);
        $firebaseDishIds = $request->getByCamelKey('firebase_dish_ids', []);
        $shop = $this->_updateShopUsecase->invoke(
            $shopId,
            $request->exceptToSnakeKeysByCamelKeys([
                FirebaseShopModel::firebase_shop_id
            ])
        ); //ここは何をしている??

        if ($firebaseShopId) {
            $this->_connectShopAndFirebaseShopUsecase->invoke(
                $shop[ShopModel::id],
                $firebaseShopId
            );
        } //DBにshopidを追加

        $this->_connectShopAndFirebaseKeywordUsecase->invoke(
            $shop[ShopModel::id],
            $firebaseKeywordIds
        ); //DBにKeyWordIdを追加
        $this->_connectshopandfirebasedishusecase->invoke(
            $shop[ShopModel::id],
            $firebaseDishIds
        ); //DBにDishIdも追加

        return Arr::camel_keys([
            'data' => array_merge($shop, [
                FirebaseShopModel::firebase_shop_id => $firebaseShopId,
                'firebase_keyword_ids'              => $firebaseKeywordIds,
            ]),
        ]);
    }
}
