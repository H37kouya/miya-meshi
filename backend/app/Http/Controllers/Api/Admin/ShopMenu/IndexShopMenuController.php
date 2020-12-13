<?php

namespace App\Http\Controllers\Api\Admin\ShopMenu;

use App\Http\Controllers\Controller;
use App\Usecases\GetShopMenusAllUsecase;
use Illuminate\Http\Request;

class IndexShopMenuController extends Controller
{
    private GetShopMenusAllUsecase $_getShopMenusAllUsecase;

    public function __construct(GetShopMenusAllUsecase $getShopMenusAllUsecase)
    {
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
        return [
            "data" => $this->_getShopMenusAllUsecase->invoke($shopId, false)
        ];
    }
}
