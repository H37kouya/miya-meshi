<?php

namespace App\Http\Controllers\Api\Admin\ShopMenu;

use App\Http\Controllers\Controller;
use App\Usecases\GetShopMenuUsecase;
use Illuminate\Http\Request;

class ShowShopMenuController extends Controller
{
    private GetShopMenuUsecase $_getShopMenuUsecase;

    public function __construct(GetShopMenuUsecase $getShopMenuUsecase)
    {
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
        return [
            'data' => $this->_getShopMenuUsecase->invoke($shopMenuId)
        ];
    }
}
