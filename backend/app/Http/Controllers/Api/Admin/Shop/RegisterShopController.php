<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Enum\Models\FirebaseShopModel;
use App\Enum\Models\ShopModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Shop\RegisterShopFormRequest;
use App\Support\Arr;
use App\Usecases\ConnectShopAndFirebaseKeywordUsecase;
use App\Usecases\ConnectShopAndFirebaseShopUsecase;
use App\Usecases\CreateShopUsecase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegisterShopController extends Controller
{
    private CreateShopUsecase $_createShopUsecase;

    private ConnectShopAndFirebaseShopUsecase $_connectShopAndFirebaseShopUsecase;

    private ConnectShopAndFirebaseKeywordUsecase $_connectShopAndFirebaseKeywordUsecase;

    public function __construct(
        CreateShopUsecase $createShopUsecase,
        ConnectShopAndFirebaseShopUsecase $connectShopAndFirebaseShopUsecase,
        ConnectShopAndFirebaseKeywordUsecase $connectShopAndFirebaseKeywordUsecase
    ) {
        $this->_createShopUsecase = $createShopUsecase;
        $this->_connectShopAndFirebaseShopUsecase = $connectShopAndFirebaseShopUsecase;
        $this->_connectShopAndFirebaseKeywordUsecase = $connectShopAndFirebaseKeywordUsecase;
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
        $firebaseKeywordIds = $request->getByCamelKey('firebase_keyword_ids', []);

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

        $this->_connectShopAndFirebaseKeywordUsecase->invoke(
            $shop[ShopModel::id],
            $firebaseKeywordIds
        );

        return Arr::camel_keys([
            'data' => array_merge($shop, [
                FirebaseShopModel::firebase_shop_id => $firebaseShopId,
                'firebase_keyword_ids'              => $firebaseKeywordIds,
            ])
        ]);
    }
}
