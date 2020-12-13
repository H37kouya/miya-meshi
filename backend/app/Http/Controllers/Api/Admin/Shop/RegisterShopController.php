<?php

namespace App\Http\Controllers\Api\Admin\Shop;

use App\Enum\Models\ShopModel;
use App\Http\Controllers\Controller;
use App\Usecases\ConnectShopAndFirebaseShopUsecase;
use App\Usecases\CreateShopUsecase;
use Illuminate\Http\Request;

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
    public function __invoke(Request $request)
    {
        $firebaseShopId = $request->get('firebase_shop_id');

        $shop = $this->_createShopUsecase->invoke($request->except(['firebase_shop_id']));

        if ($firebaseShopId) {
            $this->_connectShopAndFirebaseShopUsecase->invoke(
                $shop[ShopModel::id],
                $firebaseShopId
            );
        }

        return response()->json([
            'data' => array_merge($shop, [
                'firebase_shop_id' => $firebaseShopId
            ])
        ]);
    }
}
