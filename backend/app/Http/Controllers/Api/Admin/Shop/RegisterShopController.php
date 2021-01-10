<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Enum\Models\FirebaseShopModel;
use App\Enum\Models\ShopModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Admin\Shop\RegisterShopFormRequest;
use App\Support\Arr;
use App\Usecases\ConnectShopAndFirebaseDishUsecase;
use App\Usecases\ConnectShopAndFirebaseKeywordUsecase;
use App\Usecases\ConnectShopAndFirebaseShopUsecase;
use App\Usecases\CreateShopUsecase;
use App\Usecases\RegisterPeriodOfTime;

class RegisterShopController extends Controller
{
    private CreateShopUsecase $_createShopUsecase;

    private ConnectShopAndFirebaseShopUsecase $_connectShopAndFirebaseShopUsecase;

    private ConnectShopAndFirebaseKeywordUsecase $_connectShopAndFirebaseKeywordUsecase;

    private ConnectShopAndFirebaseDishUsecase $_connectShopAndFirebaseDishUsecase;

    //外部クラスを注入してインスタンスを作る(DI)

    public function __construct(
        CreateShopUsecase $createShopUsecase,
        ConnectShopAndFirebaseShopUsecase $connectShopAndFirebaseShopUsecase,
        ConnectShopAndFirebaseKeywordUsecase $connectShopAndFirebaseKeywordUsecase,
        ConnectShopAndFirebaseDishUsecase $connectShopAndFirebaseDishUsecase
    ) {
        $this->_createShopUsecase = $createShopUsecase;
        $this->_connectShopAndFirebaseShopUsecase = $connectShopAndFirebaseShopUsecase;
        $this->_connectShopAndFirebaseKeywordUsecase = $connectShopAndFirebaseKeywordUsecase;
        $this->_connectShopAndFirebaseDishUsecase = $connectShopAndFirebaseDishUsecase;
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
        $firebaseDishIds = $request->getByCamelKey("firebase_dish_ids", []);
        //shopの概要・詳細情報を保存する
        $shop = $this->_createShopUsecase->invoke(
            $request->exceptToSnakeKeysByCamelKeys([
                FirebaseShopModel::firebase_shop_id
            ])
        );
        //firebase(旧)のshopidとmysql(新)のshopidの紐づけ(同じ値を使うこと)
        if ($firebaseShopId) {
            $this->_connectShopAndFirebaseShopUsecase->invoke(
                $shop[ShopModel::id],
                $firebaseShopId
            );
        }
        //firebaseのkeywordを保存
        $this->_connectShopAndFirebaseKeywordUsecase->invoke(
            $shop[ShopModel::id],
            $firebaseKeywordIds
        );
        //firebaseのdishを保存
        $this->_connectShopAndFirebaseDishUsecase->invoke(
            $shop[ShopModel::id],
            $firebaseDishIds
        );
        //返却値の生成
        return Arr::camel_keys([
            'data' => array_merge($shop, [
                FirebaseShopModel::firebase_shop_id => $firebaseShopId,
                'firebase_keyword_ids'              => $firebaseKeywordIds,
                'firebase_dish_ids'              => $firebaseDishIds,
            ])
        ]);
    }
}
class RegisterPeriodOfTimeController extends Controller
{
    private CreateShopUsecase $_createShopUsecase;

    private ConnectShopAndFirebaseShopUsecase $_connectShopAndFirebaseShopUsecase;

    private ConnectShopAndFirebaseKeywordUsecase $_connectShopAndFirebaseKeywordUsecase;

    private ConnectShopAndFirebaseDishUsecase $_connectShopAndFirebaseDishUsecase;

    private RegisterPeriodOfTime $_registerperiodoftime;

    //外部クラスを注入してインスタンスを作る(DI)

    public function __construct(
        CreateShopUsecase $createShopUsecase,
        ConnectShopAndFirebaseShopUsecase $connectShopAndFirebaseShopUsecase,
        ConnectShopAndFirebaseKeywordUsecase $connectShopAndFirebaseKeywordUsecase,
        ConnectShopAndFirebaseDishUsecase $connectShopAndFirebaseDishUsecase,
        RegisterPeriodOfTime $registerperiodoftime
    ) {
        $this->_createShopUsecase = $createShopUsecase;
        $this->_connectShopAndFirebaseShopUsecase = $connectShopAndFirebaseShopUsecase;
        $this->_connectShopAndFirebaseKeywordUsecase = $connectShopAndFirebaseKeywordUsecase;
        $this->_connectShopAndFirebaseDishUsecase = $connectShopAndFirebaseDishUsecase;
        $this->_registerperiodoftime = $registerperiodoftime;
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
        $firebaseDishIds = $request->getByCamelKey("firebase_dish_ids", []);
        //shopの概要・詳細情報を保存する
        $shop = $this->_createShopUsecase->invoke(
            $request->exceptToSnakeKeysByCamelKeys([
                FirebaseShopModel::firebase_shop_id
            ])
        );
        //firebase(旧)のshopidとmysql(新)のshopidの紐づけ(同じ値を使うこと)
        if ($firebaseShopId) {
            $this->_connectShopAndFirebaseShopUsecase->invoke(
                $shop[ShopModel::id],
                $firebaseShopId
            );
        }
        //firebaseのkeywordを保存
        $this->_connectShopAndFirebaseKeywordUsecase->invoke(
            $shop[ShopModel::id],
            $firebaseKeywordIds
        );
        //firebaseのdishを保存
        $this->_connectShopAndFirebaseDishUsecase->invoke(
            $shop[ShopModel::id],
            $firebaseDishIds
        );
        //返却値の生成
        return Arr::camel_keys([
            'data' => array_merge($shop, [
                FirebaseShopModel::firebase_shop_id => $firebaseShopId,
                'firebase_keyword_ids'              => $firebaseKeywordIds,
                'firebase_dish_ids'              => $firebaseDishIds,
            ])
        ]);
    }
}
