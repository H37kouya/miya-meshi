<?php

namespace App\Http\Controllers\Api\Admin\ShopMenu;

use App\Http\Controllers\Controller;
use App\Usecases\GetShopMenuUsecase;
use App\Usecases\GetShopUsecase;
use Illuminate\Http\Request;

class ShowShopMenuController extends Controller
{
    private GetShopUsecase $_getShopUsecase;
    private GetShopMenuUsecase $_getShopMenuUsecase;

    public function __construct(
        GetShopUsecase $getShopUsecase,
        GetShopMenuUsecase $getShopMenuUsecase
    ) {
        $this->_getShopUsecase = $getShopUsecase;
        $this->_getShopMenuUsecase = $getShopMenuUsecase;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, int $shopId, int $shopMenuId)
    {
        $shop = $this->_getShopUsecase->invoke($shopId, false);
        $shopMenu = $this->_getShopMenuUsecase->invoke($shopMenuId, false);
        return [
            'data' => array_merge(
                $shop,
                [ 'shop_menu' => $shopMenu ]
            )
        ];
    }
}
