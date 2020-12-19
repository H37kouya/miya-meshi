<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Enum\Models\FirebaseShopModel;
use App\Enum\Models\ShopModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Shop\RegisterShopFormRequest;
use App\Support\Arr;
use App\Usecases\ConnectShopAndFirebaseShopUsecase;
use App\Usecases\CreateShopUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterShopController extends Controller
{
    private CreateShopUsecase $_createShopUsecase;

    private ConnectShopAndFirebaseShopUsecase $_connectShopAndFirebaseShopUsecase;

    public function __construct(
        CreateShopUsecase $createShopUsecase,
        ConnectShopAndFirebaseShopUsecase $connectShopAndFirebaseShopUsecase
    ) {
        $this->_createShopUsecase = $createShopUsecase;
        $this->_connectShopAndFirebaseShopUsecase = $connectShopAndFirebaseShopUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterShopFormRequest $request)
    {
        $firebaseShopId = $request->getByCamelKey(FirebaseShopModel::firebase_shop_id);

        $shop = $this->_createShopUsecase->invoke(
            $request->exceptToSnakeKeysByCamelKeys([
                FirebaseShopModel::firebase_shop_id
            ])
        );

        if ($firebaseShopId) {
            $this->_connectShopAndFirebaseShopUsecase->invoke(
                $shop[ShopModel::id],
                $firebaseShopId
            );
        }

        return Arr::camel_keys([
            'data' => array_merge($shop, [
                FirebaseShopModel::firebase_shop_id => $firebaseShopId
            ])
        ]);
    }
}
